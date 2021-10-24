const Peer = window.Peer;

(async function main() {
  const localVideo = document.getElementById('js-local-stream');
  const joinTrigger = document.getElementById('js-join-trigger');
  const leaveTrigger = document.getElementById('js-leave-trigger');
  const remoteVideos = document.getElementById('js-remote-streams');
  const roomId = document.getElementById('js-room-id');
  const roomMode = document.getElementById('js-room-mode');
  const localText = document.getElementById('js-local-text');
  const sendTrigger = document.getElementById('js-send-trigger');
  const messages = document.getElementById('js-messages');
  const meta = document.getElementById('js-meta');
  const sdkSrc = document.querySelector('script[src*=skyway]');

  meta.innerText = `
    UA: ${navigator.userAgent}
    SDK: ${sdkSrc ? sdkSrc.src : 'unknown'}
  `.trim();

  const getRoomModeByHash = () => (location.hash === '#sfu' ? 'sfu' : 'mesh');

  roomMode.textContent = getRoomModeByHash();
  window.addEventListener(
    'hashchange',
    () => (roomMode.textContent = getRoomModeByHash())
  );

  const localStream = await navigator.mediaDevices
    .getUserMedia({
      audio: true,
      video: true,
    })
    .catch(console.error);

  // Render local stream
  localVideo.muted = true;
  localVideo.srcObject = localStream;
  localVideo.playsInline = true;
  await localVideo.play().catch(console.error);

  // eslint-disable-next-line require-atomic-updates
  const peer = (window.peer = new Peer({
    key: '5cf1d98f-7273-48ce-aff3-54cee85ff41b',
    debug: 3,
  }));
  console.log(peer);

  // Register join handler
  joinTrigger.addEventListener('click', () => {
    // Note that you need to ensure the peer has connected to signaling server
    // before using methods of peer instance.
    if (!peer.open) {
      return;
    }

    const room = peer.joinRoom('room1', {
      mode: "sfu",
      stream: localStream,
    });
  
    

    room.once('open', () => {
      messages.textContent += '=== You joined ===\n';
    });
    room.on('peerJoin', peerId => {
      messages.textContent += `=== ${peerId} joined ===\n`;
    });

    // Render remote stream for new peer join in the room
    room.on('stream', async stream => {
      const newVideo = document.createElement('video');
      newVideo.srcObject = stream;
      newVideo.playsInline = true;
      // mark peerId to find it later at peerLeave event
      newVideo.setAttribute('data-peer-id', stream.peerId);
      remoteVideos.append(newVideo);
      await newVideo.play().catch(console.error);
    });
    console.log("here!")
    console.log(room.members.length)
    console.log(room.members.length)
    room.on('data', ({ data, src }) => {
      // Show a message sent to the room and who sent
      messages.textContent += `${src}: ${data}\n`;
    });

    // for closing room members
    room.on('peerLeave', peerId => {
      const remoteVideo = remoteVideos.querySelector(
        `[data-peer-id="${peerId}"]`
      );
      remoteVideo.srcObject.getTracks().forEach(track => track.stop());
      remoteVideo.srcObject = null;
      remoteVideo.remove();

      messages.textContent += `=== ${peerId} left ===\n`;
    });

    // for closing myself
    room.once('close', () => {
      sendTrigger.removeEventListener('click', onClickSend);
      messages.textContent += '== You left ===\n';
      Array.from(remoteVideos.children).forEach(remoteVideo => {
        remoteVideo.srcObject.getTracks().forEach(track => track.stop());
        remoteVideo.srcObject = null;
        remoteVideo.remove();
      });
    });

    // const sendText=()=>{
      
    // };
    sendTrigger.addEventListener('click', onClickSend);
    leaveTrigger.addEventListener('click',    setTimeout(room.close(),3000)
 , { once: true });

    // 🟡joinしたらで分岐処理？？
    setTimeout(room.close(),3000);


    function onClickSend() {
      // Send message to all of the peers in the room via websocket
      room.send(localText.value);

      messages.textContent += `${peer.id}: ${localText.value}\n`;
      localText.value = '';
    }
  });

  peer.on('error', console.error);
})();

if (Array.length<5){
  createNewRoom();
  joinRoom
  syoutai

}








// const Peer = window.Peer;

// (async function main() {
//   const localVideo = document.getElementById('js-local-stream');
//   const joinTrigger = document.getElementById('js-join-trigger');
//   const leaveTrigger = document.getElementById('js-leave-trigger');
//   const remoteVideos = document.getElementById('js-remote-streams');
//   const roomId = document.getElementById('js-room-id');
//   const roomMode = document.getElementById('js-room-mode');
//   const localText = document.getElementById('js-local-text');
//   const sendTrigger = document.getElementById('js-send-trigger');
//   const messages = document.getElementById('js-messages');
//   const meta = document.getElementById('js-meta');
//   const sdkSrc = document.querySelector('script[src*=skyway]');

//   meta.innerText = `
//     UA: ${navigator.userAgent}
//     SDK: ${sdkSrc ? sdkSrc.src : 'unknown'}
//   `.trim();

//   const getRoomModeByHash = () => (location.hash === '#sfu' ? 'sfu' : 'mesh');

//   roomMode.textContent = getRoomModeByHash();
//   window.addEventListener(
//     'hashchange',
//     () => (roomMode.textContent = getRoomModeByHash())
//   );

//   const localStream = await navigator.mediaDevices
//     .getUserMedia({
//       audio: true,
//       video: true,
//     })
//     .catch(console.error);

//   // Render local stream
//   localVideo.muted = true;
//   localVideo.srcObject = localStream;
//   localVideo.playsInline = true;
//   await localVideo.play().catch(console.error);

// ⭐️🟡peerのインスタンス生成？  // eslint-disable-next-line require-atomic-updates
//   const peer = (window.peer = new Peer({
//     key: '5cf1d98f-7273-48ce-aff3-54cee85ff41b',
//     debug: 3,
//   }));

//   // Register join handler
//   joinTrigger.addEventListener('click', () => {
  //     if (!peer.open) {
//       return;
//     }

// 🟦🟡roomの生成、立ち上げ？
//     const room = peer.joinRoom(roomId.value, {
//       mode: getRoomModeByHash(),
//       stream: localStream,
//     });


        // 🟦room.onceのonceメソッドがホストの処理
        // ここではルームオープン処理
        //     room.once('open', () => {
        //       messages.textContent += '=== You joined ===\n';
        //     });

                // 🟦room.onのonメソッドが通話相手の処理
                //相手の情報をとってきて参加のメッセージ処理
                //     room.on('peerJoin', peerId => {
                //       messages.textContent += `=== ${peerId} joined ===\n`;
                //     });

                //相手側の配信の処理
                //       //Render remote stream for new peer join in the room
                //     room.on('stream', async stream => {
                //       const newVideo = document.createElement('video');
                //       newVideo.srcObject = stream;
                //       newVideo.playsInline = true;
                //       // mark peerId to find it later at peerLeave event
                //       newVideo.setAttribute('data-peer-id', stream.peerId);
                //       remoteVideos.append(newVideo);
                //       await newVideo.play().catch(console.error);
                //     });

                //     room.on('data', ({ data, src }) => {
                //       // Show a message sent to the room and who sent
                //       messages.textContent += `${src}: ${data}\n`;
                //     });

                // 参加者の退出処理// for closing room members
                //     room.on('peerLeave', peerId => {
                //       const remoteVideo = remoteVideos.querySelector(
                //         `[data-peer-id="${peerId}"]`
                //       );
                //       remoteVideo.srcObject.getTracks().forEach(track => track.stop());
                //       remoteVideo.srcObject = null;
                //       remoteVideo.remove();

                //       messages.textContent += `=== ${peerId} left ===\n`;
                //     });

        // 🟦ホストのルームクローズ処理
            // for closing myself
        //     room.once('close', () => {
        //       sendTrigger.removeEventListener('click', onClickSend);
        //       messages.textContent += '== You left ===\n';
        //       Array.from(remoteVideos.children).forEach(remoteVideo => {
        //         remoteVideo.srcObject.getTracks().forEach(track => track.stop());
        //         remoteVideo.srcObject = null;
        //         remoteVideo.remove();
        //       });
        //     });

        //     sendTrigger.addEventListener('click', onClickSend);
        //     leaveTrigger.addEventListener('click', () => room.close(), { once: true });

//     function onClickSend() {
//       // Send message to all of the peers in the room via websocket
//       room.send(localText.value);

//       messages.textContent += `${peer.id}: ${localText.value}\n`;
//       localText.value = '';
//     }
//   });

//   peer.on('error', console.error);
// })();
