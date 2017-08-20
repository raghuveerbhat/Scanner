<!---
#Title: About.php
#Use: Displays the about content of the page.
#CSS: Self CSS in the Style section
#Javascipt: No Javascript
#php: No PHP and MySQL
-->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="HomeCSS.css">
    <link rel="shortcut icon" href="images/logo.ico" />
    <title>Scanned Bits</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width= device-width scale=1">
    <script src="jquery-3.1.1.min.js"></script>
    <style>
        @font-face{
            font-family: font1;
            src:url(img/font1.woff);
        }
        html{
            width: 100%;
            height: 100%;
            background: url(img/homebg.png);
        }
        .container h1{
            width:80%;
            margin: 30px auto;
            background: red;
            padding: 20px;
            color: white;
            font-family: font1;
            text-align: center;
            border: #fff dashed 5px;
            border-radius: 35px;
        }
        .text{
            width: 80%;
            overflow: auto;
            margin: 30px auto;
            padding: 25px;
            font-family: Arial;
            font-size: 22px;
            text-align: justify;
            background: green;
            color: white;
            border: #fff dashed 5px;
            border-radius: 35px;
        }
        .text ul{

        }
    </style>
    </head>
<body style="background: transparent;">
    <!--Container stores the entire document which fits the whole screen -->
    <div class="container" style="margin-top:25px;">
    <!--Contains the About title and the description -->
    <h1>About</h1>
    <div class="text">
        <p>Computer students across the world find difficult in selecting right books for learning a course. Each student differs in the way they select the book. Some want the English used to be easy, some want a simple understanding, some want in depth teaching, some even see the type of formatting of the page (the font styles and size). It becomes hard for choosing the right book for the course they want to learn.
        In this project, we divide the Computer Science into different domains like Programming, Machine Learning etc. It is further divided into subdomains like C, Java, Python etc. Every sub domain has list of books for that course which have the following ratings out of 10.</p>
        <ul>
         <li>Beginner Understandablity</li>
         <li>Complexity</li>
         <li>Level of English used</li>
         <li>Readability (Page Quality, Font style, Font size used)</li>
         <li>Price</li>
         <li>APR ( Author Publisher Recommendation)</li>
         <li>Other Ratings</li>
         <li>Scanned Bit Score (Overall Rating)</li>
        </ul>
    <p>
        Users can sort based on the requirements and select the book. Hope you have a nice time on our site.
    </p>
    </div>
    </div>
</body>
</html>