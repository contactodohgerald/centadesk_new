// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/8.2.9/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.2.9/firebase-messaging.js');


// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
firebase.initializeApp({
    apiKey: "AIzaSyCEgCLRwhOGVHEBK2h-3T9_Oo5S2Mxz2Ps",
    authDomain: "centadesk-c7f3e.firebaseapp.com",
    databaseURL: 'https://centadesk-c7f3e.firebaseio.com',
    projectId: "centadesk-c7f3e",
    storageBucket: "centadesk-c7f3e.appspot.com",
    messagingSenderId: "138970709402",
    appId: "1:138970709402:web:eabc07ae6c5085fcc2ce23",
    measurementId: "G-1W8LNZ601C"
});


// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
