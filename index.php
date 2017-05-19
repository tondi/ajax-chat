<!-- TODO: Po zostawieniu ostatniej wiadomosci na kilka sekund powstaje loop -->


<html>

<head>
    <title>Ajax Long pool Chat App</title>
    <style>
        body,
        html {
            margin: 0;
        }

        *, *:before, *:after{
            box-sizing: border-box;
        }
        
        .container {
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .board-container {
            height: 90%;
            background: gray;
            display: flex;
        }
        
        .board {
            margin: auto;
            background: white;
            width: 95%;
            height: 95%;
            padding: 1em;
        }
        
        .message-container-container {
            
        }
        
        .message-container {
            width: 90%;
            height: 10%;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        
        .message-text {
            height: 50%;
            width: 50%;
        }
        
        .message-send {
            height: 50%;
            width: 10%;
        }
        
        .message-send {}
    </style>
    <script src="./libs/jquery-3.2.1.min.js"></script>
    <link href="css/jquery.cssemoticons.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="js/jquery.cssemoticons.min.js" type="text/javascript"></script>
    
    <script>
        window.onload = function () {
           
           function pool () {
                console.log("pool")

                $.ajax({
                    method: "POST",
                    url: "handle.php",
                    success : function(data){
                        // if response contained data
                       
                        if(data){
                            console.log("file contents:", data);
                            let arr = data.split("|");
                            if(arr[2].length == 1){
                                arr[2] = 0 + arr[2];
                            }
                            let time = arr[1] + ":" + arr[2]
                            let message = arr[0]
                            // console.log(arr,time,message) 
                            let author = "testowy";

                            let messageDiv = document.createElement("div")
                            messageDiv.innerHTML = time + " " + author + ": " + message
                            
                            // document.querySelector(".board").append(messageDiv)
                            $(".board").append(messageDiv).emoticonize({
                                delay: 0,
                                animate: false
                                // exclude: 'pre, code, .no-emoticons'
                            });

                            
                        }
                    },
                    complete: pool
                })
           }
           pool();
        }

        function sendMessage() {
            var content = document.querySelector(".message-text").value + "|" + (new Date()).getHours() + "|" + (new Date()).getMinutes();
            // console.log(content)
            $.ajax({
                    method: "POST",
                    url: "add.php",
                    data: {"message": content},
                    // dataType: "json",
                    success : function(data){
                        console.log("dodano do bazy", data);
                    }
                })
            document.querySelector(".message-text").value = "";
                
        }
    </script>
    
</head>

<body>
    <div class="container">
        <div class="board-container">
            <div class="board">

            </div>
        </div>
        <div class="message-container">
            <input name="message/text" type="text" class="message-text" />

            <input autofocus type="submit" class="message-send" onclick="sendMessage()">
        </div>

    </div>
</body>

</html>