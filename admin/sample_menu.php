<ul id="nav">
  <li><a href="#">Main Item 1</a></li>
  <li><a href="#">Main Item 2</a>
    <ul>
      <li><a href="#">Sub Item</a></li>
      <li><a href="#">Sub Item</a></li>
      <li><a href="#">SUB SUB LIST &raquo;</a>
        <ul>
          <li><a href="#">Sub Sub Item 1</a>
          <li><a href="#">Sub Sub Item 2</a>
        </ul>
      </li>
    </ul>
  </li>
  <li><a href="#">Main Item 3</a></li>
</ul>
<style>

#nav {
    list-style:none inside;
    margin:0;
    padding:0;
    text-align:center;
    }

#nav li {
    display:block;
    position:relative;
    float:left;
    background: #006633; /* menu background color */
    }

#nav li a {
    display:block;
    padding:0;
    text-decoration:none;
    width:200px; /* this is the width of the menu items */
    line-height:35px; /* this is the hieght of the menu items */
    color:#ffffff; /* list item font color */
    }
        
#nav li li a {font-size:80%;} /* smaller font size for sub menu items */
    
#nav li:hover {background:#003f20;} /* highlights current hovered list item and the parent list items when hovering over sub menues */



/*--- Sublist Styles ---*/
#nav ul {
    position:absolute;
    padding:0;
    left:0;
    display:none; /* hides sublists */
    }

#nav li:hover ul ul {display:none;} /* hides sub-sublists */

#nav li:hover ul {display:block;} /* shows sublist on hover */

#nav li li:hover ul {
    display:block; /* shows sub-sublist on hover */
    margin-left:200px; /* this should be the same width as the parent list item */
    margin-top:-35px; /* aligns top of sub menu with top of list item */
    }
</style>