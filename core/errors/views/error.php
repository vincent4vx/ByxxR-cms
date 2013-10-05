<!DOCTYPE html>
<header>
    <title>Error <?php echo $code?> : <?php echo $name?></title>
    <meta charset="utf-8"/>
</header>
<div id="error">
    <style type="text/css">
        #error{
            width: 900px;
            border: 3px solid #d0cbcb;
            margin: auto;
            margin-top: 50px;
            padding: 15px;
            background: #fff;
        }
        #error h1{
            color: #560707;
            font-style: italic;
            font-size: 20px;
            margin-bottom: 25px;
            margin-left: 25px;
        }
        #error #message{
            width: 95%;
            margin: auto;
            margin-top: 25px;
            border: 2px #CCC;
            background: #F9F9F9;
            padding: 15px;
        }
        #error #message:hover{
            background: #F5F5F5;
        }
    </style>
    <h1>Error <?php echo $code?> : <?php echo $name?></h1>
    An error was encountered on file <b><?php echo $file?></b> at line <b><?php echo $line?></b>.
    
    <div id="message">
        <?php echo $msg?>
    </div>
</div>
