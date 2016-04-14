<!DOCTYPE html>
<html>
<head>
	<!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Page Title -->
	<title>Forms</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-touch-icon-152x152.png">
	<link rel="icon" type="image/png" href="/favicons/favicon-196x196.png" sizes="196x196">
	<link rel="icon" type="image/png" href="/favicons/favicon-160x160.png" sizes="160x160">
	<link rel="icon" type="image/png" href="/favicons/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
	<meta name="msapplication-TileColor" content="#254c75">
	<meta name="msapplication-TileImage" content="/favicons/mstile-144x144.png">

	<!-- CSS Files -->
	<link rel="stylesheet" href="style.css?version=1" />
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

</head>
<body id="body" class="page-template-homepage page-id-# page-slug">
<div id="main">

<div class="container">
	<div class="row">
    <div class="col-xs-24 text-center">
      <h1>Form Example</h1>
      <p>
        This is an example of the html output from contact form 7
      </p>
      <p>
        Styles for this form are within proto/bootstrap/less/rb/forms.less and proto/bootstrap/less/rb/form-additions.less
        <br/>
        The javascript for the number selectors are at the bottom of the html.
      </p>
    </div>
		<form role="form" class="col-sm-12 col-sm-offset-6">

			<div class="form-group">
				<label for="email">Email address:</label>
				<input type="email" class="form-control" id="email">
				<span class="help-block">This is some help text that appears under the input with prompts</span>
			</div>

			<div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" id="pwd">
			</div>

			<div class="form-group">
				<label for="first_name">First Name:</label>
				<input type="text" class="form-control" id="first_name">
			</div>

			<div class="form-group">
				<label for="second_name">Email address:</label>
				<input type="text" class="form-control" id="second_name">
			</div>


			<h4>Checkbox</h4>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					checkbox_single
				</label>
			</div>


			<h4>Multiple checkboxes</h4>
			<div class="checkbox">
				<label class="checkbox-inline"><input type="checkbox" value="">checkbox_multiple_1</label>
				<label class="checkbox-inline"><input type="checkbox" value="">checkbox_multiple_2</label>
				<label class="checkbox-inline"><input type="checkbox" value="">checkbox_multiple_3</label>
			</div>


			<h4>Lists</h4>
			<div class="form-group">
				<label for="sel1">Select list:</label>
				<select class="form-control" id="sel1">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
				</select>
			</div>


			<div class="form-group">
				<label for="sel2">Mutiple select list (hold shift to select more than one):</label>
				<select multiple class="form-control" id="sel2">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>
			</div>

      <div class="additional-field hidden">
        <div class="form-group clearfix child-2-name">
          <label>Hidden_field_text</label>
          <input class="form-control" name="child-2-name" type="text" value="" aria-invalid="false">
        </div>
        <div class="form-group clearfix child-2-dob">
          <label>Hidden_field_date</label>
          <input class="form-control" name="child-2-dob" type="date" aria-invalid="false">
        </div>
      </div>
      <div class="additional-field hidden">
        <div class="form-group clearfix child-2-name">
          <label>Hidden_field_text_2</label>
          <input class="form-control" name="child-2-name" type="text" value="" aria-invalid="false">
        </div>
        <div class="form-group clearfix child-2-dob">
          <label>Hidden_field_date_2</label>
          <input class="form-control" name="child-2-dob" type="date" aria-invalid="false">
        </div>
      </div>
      <div class="additional-button">
        <span>Add another feild:
          <div class="increment up"></div>
        </span>
      </div>


			<h4>Radio buttons</h4>
			<div class="radio">
				<label><input type="radio" name="radio_1">Option 1</label>
			</div>
			<div class="radio">
				<label><input type="radio" name="radio_1">Option 2</label>
			</div>
			<div class="radio disabled">
				<label><input type="radio" name="radio_1" disabled>Option 3</label>
			</div>


			<h4>Inline Radio buttons</h4>
			<div class="radio">
				<label class="radio-inline"><input type="radio" name="radio_2">Option 1</label>
				<label class="radio-inline"><input type="radio" name="radio_2">Option 2</label>
				<label class="radio-inline"><input type="radio" name="radio_2">Option 3</label>
			</div>


			<div class="form-group">
				<label for="comment">Comment:</label>
				<textarea class="form-control" rows="5" id="comment"></textarea>
			</div>


			<div class="form-group sr-only">
				<label for="robot_check">Please don't fill this section out:</label>
				<input type="text" class="form-control" id="robot_check">
			</div>

      <div class="quantity-select">
        <div class="increment up"></div>
        <div class="form-group clearfix book-2015">
          <label>Number_1</label>
          <input class="custom-buttons form-control" name="number1" type="number" value="0" min="0" max="99" step="" aria-invalid="false"></div>
        <div class="increment down"></div>
      </div>
      <div class="quantity-select">
        <div class="increment up"></div>
        <div class="form-group clearfix book-2015">
          <label>Number_2</label>
          <input class="custom-buttons form-control" name="number1" type="number" value="0" min="0" max="99" step="" aria-invalid="false"></div>
        <div class="increment down"></div>
      </div>

			<button type="submit" class="btn btn-default">Submit</button>

		</form>

	</div>
</div>

</div><!--main-->

<!-- JS files -->
<!-- Jquery -->
<script src="js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8" ></script>

<!-- Bootstrap core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>

<!-- Custom JS files -->
<script src="js/custom.js" type="text/javascript" charset="utf-8"></script>

<script>
// Add quantity selectors for number elements
function quantitySelectChange(parentEle, val){
	var $target = parentEle.find('input');
	var currentValue = 0;
	if ($target[0].value){
		currentValue = parseInt($target[0].value);
	}
	if ( currentValue+val >= $target.attr('min') && currentValue+val <= $target.attr('max') ){
		$target[0].value = currentValue+val;
	}
}
$(document).ready(function() {
  $('.quantity-select .increment').click(function(event) {
		var changeBy = 0;
		if ( $(this).hasClass('up') ){
			changeBy = 1;
		}
		else if ( $(this).hasClass('down') ){
			changeBy = -1;
		};
		var $thisParent = $(this).parent();
		quantitySelectChange( $thisParent, changeBy);
	});

  // Show 1 hidden field on click. If there are no more to show then hide the button.
  $('.additional-button .increment').click( function(){
		if ( $('.additional-field.hidden').length > 1 ) {
			$('.additional-field.hidden:eq(0)').removeClass('hidden');
		}
		else{
			$('.additional-field.hidden:eq(0)').removeClass('hidden');
			$('.additional-button').addClass('hidden'); // Change this class to something other than hidden if you want the button to change in some other way.
		};
	});
});
</script>

<!-- Analytics -->
<? /*
<script src="js/analytics.js" type="text/javascript" charset="utf-8" async defer></script>

<noscript>
	<div>
		<img src="//mc.yandex.ru/watch/29248395"  style="position:absolute;left:-9999px;" alt="" />
	</div>
</noscript>
*/?>

</body>
</html>
