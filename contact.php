<!DOCTYPE html>
<html>

  <head>
    <link rel="stylesheet" href="contactstyle.css">
     <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Montserrat">
      
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="contactscript.js"></script>
    <title> Health&amp;Spa centar<br>Minnie</title>
  </head>

  <body>
    <!-- Navigacijski meni -->
      <ul class="navbar">
    <li><a id="cvjetic" href="index.php"><div class="logo">
			<div id="cvijet"></div>
			<div id="sredina"></div>
			<div id="latica1"></div>
			<div id="latica2"></div>
			<div id="latica3"></div>
			<div id="latica4"></div>
			<div id="latica5"></div>
			<div id="latica6"></div>
			<div id="latica7"></div>
			<div id="latica8"></div>
		</div></a></li>
    <li><a class="tekst" href="index.php">Home page</a>
    <li><a class="tekst" href="services.php">Services</a>
    <li><a class="tekst" href="contact.php">Contact</a>
    <li><a class="tekst" href="links.php">Links</a>
  </ul>
  <div id="form-main">
  <div id="form-div">
    <form class="form" id="form1">
      <p class="name">
        <label for="name">Name:</label>
        <input name="name"  onkeypress="validate(this)" onfocusout="validate(this)"type=text class="feedback-input" placeholder="Must be filled" id="name" required/>
      </p>
      
      <p class="email">
          <label for="email">Email:</label>
  
        <input name="email" onkeypress="validate(this)" onfocusout="validate(this)" type="email" class="feedback-input" id="email" placeholder="e.g. emina@emina.ba" required />
      </p>
       <p class="tel">
         <label for="tel">Telephone:</label>
         <input type="tel"  onkeypress="validate(this)" onfocusout="validate(this)" class="feedback-input" name="tel" id="tel" placeholder="e.g. 061/111-222 or 061-111-222 or 061111222" pattern: " /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.\/]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{3}$/" required>
      </p>
      
      <p class="date">
        <label for="dob">Date of birth:</label>
        <input id="dob" class="feedback-input" name="dob" type="date" required>
      </p>
      <p class="text">
          <label for="comment">Message:</label>
        <textarea name="text "  onkeypress="validate(this)" onfocusout="validate(this)" class="feedback-input" id="comment" placeholder="Name must be filled first" required></textarea>
      </p>
      

      <div class="submit">
        <input type="submit" value="SEND" id="button-gray" onclick="validateButton(this)"/>
        <div class="ease"></div>
      </div>
    </form>
  </div>
  </div>
  
  
  </body>

</html>