'use strict';
let $ = jQuery;
let base_url = 'https://wp.localserverpro.com/astro/';
let pc;
let localStream;
const localVideo = document.getElementById("localVideo");
const remoteVideo = document.getElementById("remoteVideo");
const mediaConst = { video: false, audio: true }; // media option
// selector
let videoCallBtn = $("#videoCallBtn");
let audioCallBtn = $("#audioCallBtn");

let declinBtn = $("#declinBtn");
let answerBtn = $("#answerBtn");
let sendTo = videoCallBtn.attr("user_id");


const config = {
    iceServers: [
        {
            "urls": "stun:stun1.l.google.com:19302"
        }
    ]
};  // for voice 
const options = {
    offerToReceiveVideo: 1,
    offerToReceiveAudio: 1
};

async function getConn() {
    if (!pc) {
        pc = new RTCPeerConnection(config);
    }
}
async function getCam() {
    let mediaStream;
    try {
        if (!pc) {
            await getConn();
        }
        mediaStream = await navigator.mediaDevices.getUserMedia(mediaConst);
        localVideo.srcObject = mediaStream;
        localStream = mediaStream;
        localStream.getTracks().forEach(track => pc.addTrack(track, localStream))
    } catch (error) {
        console.log(error);
    }
}

async function createOffer(sendTo) {
    await sendIceCandidate(sendTo);
    await pc.createOffer(options);
    await pc.setLocalDescription(pc.localDescription);
    send('client-offer', pc.localDescription, sendTo);
}

async function createAnswer(sendTo, data) {
    if (!pc) {
        await getConn();
    }
    if (!localStream) {
        await getCam();
    }
    await sendIceCandidate(sendTo);
    await pc.setRemoteDescription(data);
    await pc.createAnswer();
    await pc.setLocalDescription(pc.localDescription);
    send('client-answer', pc.localDescription, sendTo);
    $(".video-call-module").removeClass("hidden");

}

async function sendIceCandidate(sendTo) {
    pc.onicecandidate = (e) => {
        if (e.candidate !== null) {
            // send ice candidate to other client
            send('client-candidate', e.candidate, sendTo);
        }
    }
    pc.ontrack = (e) => {
        console.log(e.streams);
        remoteVideo.srcObject = e.streams[0];
        hideCall();
    }
}
function hangup() {
    send('client-hangeup', null, sendTo);
    pc.close();
    pc = null;
}
function send(type, data, sendTo, callType = "") {
    conn.send(JSON.stringify({
        sendTo: sendTo,
        data: data,
        type: type,
        callType: callType
    }));

}



// Fire Event
$("#videoCallBtn").click(function () {
    getCam();
    send('is-client-ready', null, sendTo, 'video');
    mediaConst = { video: true, audio: true };
});

$("#audioCallBtn").click(function () {
    getCam();
    send('is-client-ready', null, sendTo, 'audio');
    mediaConst = { video: false, audio: true };
});


$("#hangupBtn").click(function () {
    hangup();
    location.reload(true);
});

// common function for show/hide model
function displayCall() {
    $("#videocallModal").modal({ backdrop: "static", keyboard: false }, "show");
}
function hideCall() {
    $(".video-call-module").addClass("hidden");
}

function disconnectingCall() {
    $("#disconnectvideocallModal").modal("show");
    setTimeout(() => window.location.reload(true), 2000)
}

// two functions for webrtc 

conn.onopen = function (e) {
    console.log("Connection established!");
};

conn.onmessage = async function (e) {
    let message = JSON.parse(e.data);
    let by = message.by;
    let type = message.type;
    let data = message.data;
    let user_name = message.user_name;
    let user_id = message.user_id;
    switch (type) {
        case 'is-client-ready':
            if (!pc) {
                await getConn();
            }
            if (pc.iceConnectionState === 'connected') {
                send('client-already-oncall', null, by);
            }
            else {
                displayCall();
                if (window.location.href.indexOf(user_id) > -1) {
                    answerBtn.on('click', () => {
                        send('client-is-ready', null, sendTo);
                    });
                }
                else {
                    answerBtn.on('click', () => {
                        redirectToCall(user_id, by);
                    });
                }

                declinBtn.on('click', function () {
                    send('client-rejected', null, sendTo);
                    location.reload(true);
                });
            }
            break;
        case 'client-is-ready':
            createOffer(sendTo);
            break;
        case 'client-offer':
            createAnswer(sendTo, data);
            timerSetup(); // display timer for reciever
            break;
        case 'client-candidate':
            if (pc.localDescription) {
                await pc.addIceCandidate(new RTCIceCandidate(data));
            }
            openCallPanel();
            //$(".video-call-module").removeClass("hidden");
            break;
        case 'client-answer':
            if (pc.localDescription) {
                await pc.setRemoteDescription(data);
                timerSetup(); // display timer for caller
                let object = {
                    action: 'setCallTime',
                    total_call_time: (new Date()).getTime()
                };
                $.ajax({
                    url: "http://localhost:8081/codeflies/astro/wp-admin/admin-ajax.php",
                    method: "POST",
                    data: object,
                    success: function (data) {
                        console.log("Okey");
                    }
                });
            }
            break;
        case 'client-already-oncall':
            setTimeout('window.location.reload(true)', 2000)
            break;
        case 'client-rejected':
            disconnectingCall();
            hideCall();
            break;
        case 'client-hangeup':
            disconnectingCall();
            setTimeout('window.location.reload(true)', 2000)
            break;
    }

};


function timerSetup() {
    $("#timer").timer({
        format: '%m:%s', duration: '10m',
        callback: function () {
            //console.log($("#timer").data('seconds'));
            $('#timer').timer('pause');
        }
    });
}


function openCallPanel() {
    $(".video-call-module").removeClass("hidden");
}

function redirectToCall(user_id, sendTo) {
    if (window.location.href.indexOf(user_id) == -1) {
        sessionStorage.setItem("redirect", true);
        sessionStorage.setItem("sendTo", sendTo);
        window.location.href = base_url + 'user-video-connect/' + user_id + '/';
    }

}
if (sessionStorage.getItem("redirect")) {
    let sendTo = sessionStorage.getItem("sendTo");
    let waitForWS = setInterval(() => {
        if (conn.readyState === 1) {
            send('client-is-ready', null, sendTo);
            clearInterval(waitForWS);
        }
    }, 500);
    sessionStorage.removeItem("redirect");
    sessionStorage.removeItem("sendTo");
}