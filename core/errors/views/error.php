<header>
    <title><?php echo I18n::tr('error_title', 'errors', $code, $name)?></title>
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
    <h1><?php echo I18n::tr('error_title', 'errors', $code, $name)?></h1>
    <?php echo I18n::tr('error_msg', 'errors', $file, $line)?>
    <div id="message">
        <?php echo I18n::tr($msg, 'errors')?>
    </div>
</div>
