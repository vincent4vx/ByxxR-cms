<html>
    <head>
        <title>Fatal error : <?php echo $this->title ?></title>
        <meta charset="utf-8"/>
    </head>
    <div id="exception">
        <style>
            #exception{
                position: absolute;
                top: 0;
                background: #FFF;
                width: 100%;
                height: 100%;
                left: 0;
                color: #000;
                text-align: left;
                padding: 0;
                margin: 0;
                font-size: 14px;
            }
            #exception #content{
                border: 3px solid #d0cbcb;
                width: 900px;
                margin: auto;
                margin-top: 50px;
                padding: 15px;
            }
            #exception h1{
                color: #560707;
                font-style: italic;
                font-size: 20px;
                margin-bottom: 25px;
                margin-left: 25px;
            }
            #message h2{
                font-size: 16px;
                margin-left: 10px;
            }
            #exception #content #message{
                width: 95%;
                margin: auto;
                margin-top: 25px;
                border: 2px #CCC;
                background: #F9F9F9;
                padding: 15px;
            }
            #exception #content #message:hover{
                background: #F5F5F5;
            }
        </style>

        <div id="content">
            <h1><?php echo $this->title ?></h1>

            An Exception has been thrown on file <b><?php echo $this->getFile() ?></b> at line <b><?php echo $this->getLine() ?></b>.

            <div id="message">
                <?php echo $this->message ?>
            </div>
        </div>
    </div>
</html>