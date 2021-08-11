<?php
/**
 * Template Name: Mortgage-Calc
 * Description: A full-width template with no sidebar
 *
 * @package WordPress
 * @subpackage Powered By
 */

get_header(); ?>

		<div id="primary" class="full-width">
			<div id="content" role="main">

				
<form name="form1">
<!--start of mortgage details-->
<h4 class="mym4">MORTGAGE CALCULATOR</h4>
<fieldset class="mortgageCalc">
	<p>
		<label for="amount">Mortgage required</label><br>
		<span class="pound">£</span><input name="amount" id="amount" class="fixit" type="text">
	</p>
	<p>
		<label for="period">Repayment period</label><br><span class="notex">eg 25 for 25 years</span><br>
		<span class="poundx">£</span><input name="period" id="period" class="mrate" type="text"><span class="unit">years</span>
	</p>
	<p>
		<label for="interest_rate">Interest rate (%)*</label><br>
		<span class="poundx">£</span><input name="rate" id="rate" class="mrate" type="text">
		<!--<input type="reset" value="clear" class="button" id="clear_butt" />-->
	</p>
	<p>
		<span class="poundx">£</span><input value="Calculate" class="button" id="calculateMortgage" type="button">	
	</p>
	<p>
		<label for="mp">Repayment mortgage</label><br>
		<span class="pound">£</span><input name="mp" id="mp" class="fixit" type="text"><span class="unit">monthly</span>
	</p>
	<p class="last">
		<label for="ei">Interest only</label><br>
		<span class="pound">£</span><input name="ei" id="ei" class="fixit" type="text"><span class="unit">monthly</span>
	</p>
	<ul class="ulmnote"><li class="mnote">*Remember interest rates may vary</li></ul>
	<p class="mnotet"><a href="http://news.bbc.co.uk/1/hi/business/your_money/7036088.stm">Mortgage calculator explained</a></p>
</fieldset><!--end of rate change-->
</form>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>