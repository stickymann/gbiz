var firstload = true, initqty, tmpqty;

$(document).ready(function()
{
	initqty = $('#qty_instock').val();
	tmpqty = $('#qty_instock').val();
});
	
var inventory = new function() 
{		
	this.LoadForm = function()
	{
		var cp_params = "";
			
		siteutils.dialogWindow("chklight",300,170,"Adjust Stock");
		if(firstload)
		{
			$('#chkresult').html( this.AdjustForm() );
			$('#qty').keyup(function(){ this.SetChangeInputs() });
			$('#qty_add').change(function(){ this.SetChangeInputs() });
			$('#qty_minus').change(function(){ this.SetChangeInputs() });
			firstload = false;
		}
	}
		
	this.SetChangeInputs = function()
	{
		if( isNaN( $('#qty').val() ))
		{
			$('#qty').val(tmpqty);
		}
			
		// prevent negative qty
		if( $('#qty').val() < 0 )
		{ 
			$('#qty').val('0.00'); 
		}
					
		$('#qty_instock').val( $('#qty').val() );

		if( $('#qty_add').val() < 1 )
		{ 
			$('#qty_add').val('1'); 
		}

		if( $('#qty_minus').val() < 1 )
		{ 
			$('#qty_minus').val('1'); 
		}
	}

	this.AdjustForm = function()
	{
		qty = $('#qty_instock').val();
		var html = "";
		html += "<table>";
		html += "<tr><td>Quantity :</td><td><input type='text' id='qty' name='qty' size='12' value='"+ qty +"'/> <input type='submit' id='reset' name='reset' value='Reset' onclick='window.inventory.QtyReset();'/></td></tr>";
		html += "<tr><td>Adjust :</td><td>";
		html += "<input type='text' id='qty_minus' name='qty_minus' size='12' value='1'/> <input type='submit' id='qty_minus' name='qty_minus' value='- ' onclick='window.inventory.QtyMinus();'/></td></tr>";
		html += "<tr><td>&nbsp</td><td>";
		html += "<input type='text' id='qty_add' name='qty_add' size='12' value='1'/> <input type='submit' id='qty_add' name='qty_add' value='+' onclick='window.inventory.QtyAdd();'/></td></tr>";
		html += "</td></tr></table>";
		return html;
	}

	this.QtyAdd = function()
	{
		if( $('#qty').val()=="" ) { $('#qty').val("0.00"); } 
		var sum = parseFloat( $('#qty').val() ) + parseFloat( $('#qty_minus').val() );
		$('#qty').val( sum.toFixed(2) );
		$('#qty_instock').val( $('#qty').val() );
		tmpqty = $('#qty').val();
	}
		
	this.QtyMinus = function()
	{
		var sum = parseFloat( $('#qty').val() ) - parseFloat( $('#qty_minus').val() );
		$('#qty').val(sum.toFixed(2));
		
		if( sum <= 0 )
		{
			$('#qty').val("0.00")
		}
			
		$('#qty_instock').val( $('#qty').val() );
		tmpqty = $('#qty').val();
	}
		
	this.QtyReset = function()
	{
		$('#qty').val(initqty);
		$('#qty_instock').val( $('#qty').val() );
		tmpqty = $('#qty').val();
	}
}
