
	<div class="success" style="text-color: grey">
		<?php
		if(isset($_SESSION['success'])){ ?>	
			<h4 style="color: black;">
				<p style="color: green"><?php echo $_SESSION['success']; ?></p>
				<strong class="lighter block green"></strong>
			</h4>
			<?php 
			unset($_SESSION['success']); 			
		}
		?>
	</div>

	<div class="error" style="text-color: red">
		<?php
		if(isset($_SESSION['error'])){ ?>	
			<h4 style="color: white;">
				<p style="color: red"><?php echo $_SESSION['error']; ?></p>
				<strong class="lighter block red"></strong>
			</h4>
			<?php
			unset($_SESSION['error']); ?></h4>	<?php
		} 
		?>
	</div>