# PHP tpl
PHP tpl is a **Simple block template processing class**.


### Block Definition
A *block* is a string variable with two square brackets surrounding it. The block content will look like `[content]`. 


### How it works
Take a simple HTML/XHTML/XML file and read it for *block* content based on the array name passed when a file is processed. When a *block* is found the block content is replaced with the string contained in the array defining the block. If multiple *blocks* are defined all *blocks* found will be replaced with the string contained in the array.


### About
The original idea was created to allow easier processing of HTML/XHTML/XML files. In large team development projects designers would use WYSIWYG editors to create the HTML/XHTML/XML type file. A need for faster processing of new designs while keeping the business logic of the program in tact.


# Example code

### HTML to be parsed/processed
Basic HTML with a *"content"* *block*.

```xml
<html>
<body>

Content here : [content]

</body>
</html>
```


### PHP Code:
1. Include the class file
2. Instantiate the tpl object
3. Use an array of "blocks" which contain content that will be replaced
4. Process the output
5. Display the content


```php
<?php
$strTemplateFile = "template.tpl.html";
$strContent = "This is the content!";


include_once ("tpl.class.inc.php"); // include class file
$refTPL = new tpl(); // instantiate object
$arrContent['content'] = $strContent; // create block for [content]
$refTPL->go($strTemplateFile, $arrContent); // process template
echo $refTPL->get_content(); // display processed template
?>
```
