
    <!DOCTYPE html>
    <head>
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="bootstrap.min.js"></script>
    <script type="text/javascript" src="jquery-3.3.1.min.js"> </script>
   
    <script type="text/javascript">

    var previousTagId = "";

    var checkTagId = function() {
        var intr = setInterval(function() {

            $.get('output.txt', function(data) {
            var tagsArray = [];
            var timeArray = [];
            var lines = data.split('\n');

            for (var i = 0; i < lines.length; i++) {

                var tempArray = lines[i].split(',');

                var reTags = /In hex:  /;
                var reTime = /time: /;

                if(reTags.test(tempArray[0])){
                    var tagId = tempArray[0].replace(reTags, "");
                    window.tagId = tagId.replace(/\s/g, '');
                    tagsArray.push(tagId.replace(/\s/g, ''));
                    // console.log(tagsArray);
                    // console.log(tagId);
                }

                if(reTime.test(tempArray[1])){
                    var time = tempArray[1].replace(reTime, "");
                    timeArray.push(time);
                    window.time = time;
                }
            }
            window.tagId = tagsArray[tagsArray.length-1];
            window.time = timeArray[timeArray.length-1];
            // console.log(window.time);
            // console.log(window.tagId);
        }, 'text');

        if (previousTagId != tagId) {
            $.ajax({    //create an ajax request to display.php
       type: "GET",
       url: "display.php",
       data: {tagid: tagId, time: time},        
       dataType: "html",   //expect html to be returned                
       success: function(response){                    
           $("#responsecontainer").html(response); 
           //alert(response);
       }
   });

   console.log(previousTagId);

   previousTagId = window.tagId;

   console.log(window.tagId);

        }

//         $(document).ready(function() {
   
//    $("#display").click(function() {                

//      $.ajax({    //create an ajax request to display.php
//        type: "GET",
//        url: "display.php",
//        data: {tagid: tagId},        
//        dataType: "html",   //expect html to be returned                
//        success: function(response){                    
//            $("#responsecontainer").html(response); 
//            //alert(response);
//        }
//    });
// });
// });

        }, 1000);
        
    }

    // $.get('output.txt', function(data) {
    //     var tagsArray = [];
    //     var lines = data.split('\n');
    //     for (var i = 0; i < lines.length; i++) {
    //         var re = /Card UID: /;
    //         if(re.test(lines[i])){
    //             var tagId = lines[i].replace(re, "");
    //             window.tagId = tagId.replace(/\s/g, '');
    //             tagsArray.push(tagId.replace(/\s/g, ''));
    //             console.log(tagsArray);
    //             console.log(tagId);
    //         }
    //     }
    //     window.tagId = tagsArray[tagsArray.length-1];
    // }, 'text');
   
//     $(document).ready(function() {
   
//        $("#display").click(function() {                

//          $.ajax({    //create an ajax request to display.php
//            type: "GET",
//            url: "display.php",
//            data: {tagid: tagId},        
//            dataType: "html",   //expect html to be returned                
//            success: function(response){                    
//                $("#responsecontainer").html(response); 
//                //alert(response);
//            }
//        });
//    });
//    });

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}


checkTagId();
   
   </script>

   <style>
        .clock {
            'font-size'
        }
    </style>
   </head>
   
   <body onload="startTime()">
   <div style="width:80%; ">
   <h1 align="center">Gate Record Details</h1>
   <div id="txt" class='clock' style="font-size:30px; float:right"></div>
   <br>
   
   <div id="responsecontainer" align="center">
   </div>
   
   </div>
   </body>
   </html>