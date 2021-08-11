MortgageCalculator = function()
{
this.dom = new newsi.HTML.DOM();
//this.pv = new ProcessValue();
this._execComputeMortgage();
}
//MortgageCalculator.prototype = new ProcessValue();
MortgageCalculator.prototype._execComputeMortgage = function()
{
this["calculate"] = new newsi.Event();
this["calculate"].addListener("onclick","calculateMortgage",this,"checkMortgageBounds","false");
}
MortgageCalculator.prototype.checkMortgageBounds = function()
{
this.checkForEmptyFields();
//this.computeMortgage();
if ( !mc.checkNumber( document.form1.amount , 1 , 9999999 , "Mortgage required" ) ||
!mc.checkNumber( document.form1.rate , .001 , 1000 , "Interest rate" ) ||
!mc.checkNumber( document.form1.period , 3 , 40 , "Repayment period" ) )
{
}
}
MortgageCalculator.prototype.checkNumber = function( input , min , max , msg )
{
msg = msg + " has invalid data: " + input.value;
var str = input.value;
for ( var i = 0 ; i < str.length ; i++ )
{
var ch = str.substring( i , i + 1 )
if ( ( ch < "0" || "9" < ch ) && ch != '.' )
{
alert(msg);
return false;
}
}
var number = 0 + str
if ( number < min || max < number ) {
alert( msg + " Enter a value in range: " + min + " - " + max );
return false;
}
input.value = str;
return true;
}
MortgageCalculator.prototype.extractMortgageValues = function()
{
var mv,
mv = document.form1.amount.value;
mv = mv.split(",");
mv = mv.join("");
this.A = parseFloat(mv);
this.T = document.form1.period.value;
this.R = document.form1.rate.value;
document.form1.amount.value = mc.poundsPence( this.A );
}
MortgageCalculator.prototype.checkForEmptyFields = function()
{
this.extractMortgageValues();
if( this.A == null || this.A.length == 0 || isNaN( this.A ))
{
document.form1.amount.value = "";
document.form1.amount.focus();
}
else if( this.T == null || this.T.length == 0 )
{
document.form1.period.focus();
}
else if( this.R == null || this.R.length == 0 )
{
document.form1.rate.focus();
}
else{
this.repaymentsCalculations();
}
}
MortgageCalculator.prototype.repaymentsCalculations = function()
{
R = this.R / 100;
var P = ((( this.A * R ) / 12 ) * ( 1 / ( 1 - ( Math.pow( 1 / ( 1+R ) , this.T ))))).toFixed(0);
document.form1.mp.value = mc.poundsPence( P );
P = (( this.A * R )/ 12 ).toFixed(0)
document.form1.ei.value = mc.poundsPence( P );
}
MortgageCalculator.prototype.poundsPence = function( N )
{
S = new String( N );
var i = S.indexOf( '.' );
if ( i != -1 ) {
S = S.substr( 0, i+3 );
if ( S.length-i < 3 )
S = S + '0';
}
return S;
}
