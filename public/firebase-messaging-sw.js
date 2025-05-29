importScripts("https://www.gstatic.com/firebasejs/10.12.0/firebase-app-compat.js");
importScripts("https://www.gstatic.com/firebasejs/10.12.0/firebase-messaging-compat.js");

const firebaseConfig = {
    apiKey: "AIzaSyCdgV6kwhRJFWaux8YBjjeaqPNoisA9KjQ",
    authDomain: "healthtrackapp-be4ec.firebaseapp.com",
    projectId: "healthtrackapp-be4ec",
    storageBucket: "healthtrackapp-be4ec.firebasestorage.app",
    messagingSenderId: "104168353896",
    appId: "1:104168353896:web:ad5d07b284252b7b1e8bdd",
    measurementId: "G-7WZR1J8S5Y"
};

firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: 'https://raw.githubusercontent.com/Ryandra-TI01/Aplikasi-HealthTrack/refs/heads/main/public/images/LOGO%20-%20HealthTrack.png',
        data: {
            url: payload.data?.url || payload.notification?.click_action || '/'
        }
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});


self.addEventListener('notificationclick', function(event) {
  const urlToOpen = event.notification.data?.url || event.notification.click_action || '/';

  event.notification.close();

  event.waitUntil(
    clients.matchAll({ type: 'window', includeUncontrolled: true }).then(function(clientList) {
      for (let i = 0; i < clientList.length; i++) {
        const client = clientList[i];
        if (client.url === urlToOpen && 'focus' in client) {
          return client.focus();
        }
      }
      if (clients.openWindow) {
        return clients.openWindow(urlToOpen);
      }
    })
  );
});