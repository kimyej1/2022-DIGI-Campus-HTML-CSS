<div class="container"> <!--Container : 양쪽에 여백을 적당하게 남겨둔다-->
	<div class="row">
		<div class="col colLine">
			<h4 class="text-primary">
				<span class="material-icons icon">double_arrow</span>Input</h4> 
		</div>
	</div>

	<!-- Offcanvas Sidebar(Left) -->
	<div class="offcanvas offcanvas-start" id="leftSlide"> <!--offcanvas-start : 왼쪽에서 열림, -end : 오른쪽에서 열림-->
		<div class="offcanvas-header">
			<h1 class="offcanvas-title">Left Slide</h1>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
		</div>
		<div class="offcanvas-body">
			<p>Some text lorem ipsum.</p>
			<p>Some text lorem ipsum.</p>
			<p>Some text lorem ipsum.</p>
			<button class="btn btn-secondary" type="button">A Button</button>
		</div>
	</div>
		
	<div class="row">
		<div class="col">
			<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#leftSlide">
				Open Left Offcanvas Sidebar
			</button>
		</div>
	</div> <!-- Offcanvas Sidebar(Left) -->

	<!-- Offcanvas Sidebar(Right) -->
	<div class="offcanvas offcanvas-end" id="rightSlide">
		<div class="offcanvas-header">
			<h1 class="offcanvas-title">Right Slide</h1>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
		</div>
		<div class="offcanvas-body">
			<p>Some text lorem ipsum.</p>
			<p>Some text lorem ipsum.</p>
			<p>Some text lorem ipsum.</p>
			<button class="btn btn-secondary" type="button">A Button</button>
		</div>
	</div>
		
	<div class="row">
		<div class="col">
			<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#rightSlide">
				Open Right Offcanvas Sidebar
			</button>
		</div>
	</div> <!-- Offcanvas Sidebar(Right) -->
	
</div> <!--Container-->