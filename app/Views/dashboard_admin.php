<!DOCTYPE html>
<html>
<head>
	<script src="<?= base_url('../upload/jquery.min.js')?>"></script>
	<style type="text/css">
		.container {
  display: flex;
}
.main_container{
		background-color: #eeffec;
		height: fit-content;
		width: 80%;
		margin-top: 15mm;
		margin-left: 20%;
	}
	.main_header{
		padding: 10px;
	}
	.main_body{
		padding: 10px;
		height: 130%;
	}
	</style>
<meta name="viewport">
	<?=$this->include('navbar');?>
<div class="container">
	<?=$this->include('sidebar_admin');?>
  <div class="main_container">
  	<div class="main_header"><h3 style="margin: 0px;">Dashboard</h3></div>
  	<div class="main_body">
  		<form>
  			 <label for="cars">Periode penggajian:</label>
				<select id="cars" name="cars">
				  <option value="volvo">Januari 2024</option>
				  <option value="fiat">Maret 2024</option>
				  <option value="audi">Mei 2024</option>
				</select> 
  		</form>
		</div>
  </div>
</div>

<script>
	const working_unit_option = [];
	working_unit_option.push({id:"1", name:"PT Multipolar"});
	working_unit_option.push({id:"2", name:"PT Jagung Rebus"});
	working_unit_option.push({id:"3", name:"PT Jawa Power"});
	working_unit_option.push({id:"4", name:"PT Duta Sarana"});

</script>
