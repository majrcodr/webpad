if (localStorage.getItem('root') == "") {
   //First visit (I hope)
   localStorage.setItem('root',window.location.href);
} else {
var selectDir;
var showDirs = false;
var uri;
var chosenDir;



window.onload = function() {
   uri = document.getElementById('ss').href.substr(0,String(document.getElementById('ss').href).length - 9);
   chosenDir = window.location.href.substr(uri.length + 1,window.location.href.length);
   showDirs = window.location.href.substr(window.location.href.length - 9, window.location.href.length);
   if (showDirs == "?dir=true") {
      //Only showing directories
      showDirs = true;
   } else {
      //Showing files as well
      showDirs = false;
   }
   document.getElementById('contents').focus();
   document.getElementById('contents').addEventListener('click', function() {
      window.getSelection().selectAllChildren(document.getElementById('contents'));
      // document.getElementById('contents').innerHTML = findAndReplace('&nbsp;','',document.getElementById('contents').innerHTML);
});
   //window.setInterval(function() {document.getElementById('saveBtn').click();}, 10000);
};

function saveFile() {
   var data = document.getElementById('contents').innerText;
   var file = document.getElementById('file').innerText;
   var dir = document.getElementById('dir').innerText;
   file = file;
   dir = dir;
   //$("#file").remove();
   //$("#dir").remove();
   //console.log(file);
   //console.log(dir);
   $.post("/save.php", {contents:data, file:file, dir:dir},
function(response,status){
   if (status !== "success") {
      //Something went wrong
      alert('There was an error while trying to save your file. Please try again.');
   } else {
      document.getElementById('header').innerText = "File saved!";
      window.setTimeout(function() {document.getElementById('header').innerText = "WebPad v0.01";}, 700);
   }
});
}

function onClick(event) {
   var x = window.event;
   if (selectDir) {
      x.preventDefault();
      var newDir = x.srcElement.href.substr(uri.length + chosenDir.length + 14, x.srcElement.href.length);
      window.location.href = uri + "/" + chosenDir + "/" + newDir;
   } else {
      //Absolutely nothing
   }
}

function keyDown(event) {
   var x = window.event;
   switch (x.code) {
      case "KeyS":
         selectDir = false;
         switch (x.ctrlKey) {
            case true:
               x.preventDefault();
               document.getElementById('saveBtn').click();
               break;
            default:
               //Nothing
         }
         break;
      case "ControlLeft":
         selectDir = true;
         break;
      case "ControlRight":
         selectDir = true;
         break;
      case "KeyD":
         switch (x.ctrlKey) {
            case true:
               if (showDirs) {
                  //Already showing directories
                  x.preventDefault();
                  window.location.href = window.localStorage.getItem('root');
               } else {
                  x.preventDefault();
                  window.location.href = window.localStorage.getItem('root') + "?dir=true";
               }
               break;
            default:
               //Nothing
               break;
         }
         break;
      default:
         selectDir = false;
         break;
   }
} 
}