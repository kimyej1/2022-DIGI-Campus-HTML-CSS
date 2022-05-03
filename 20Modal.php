<div class="container"> <!--Container : 양쪽에 여백을 적당하게 남겨둔다-->
	<div class="row">
		<div class="col colLine">
			<h4 class="text-primary">
				<span class="material-icons icon">double_arrow</span>Input</h4> 
		</div>
	</div>

	<div class="row">
		<div class="col">
			<button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#myModal">
			Modal Toggle</button> <!--myModal 이라는 id를 찾아서 토글시켜라-->
		</div>
	</div>

	<!-- The Modal : 창에 레이어가 하나 뜨는데, 뒷쪽은 딤처리되어서 포커싱되는 효과-->
	<div class="modal" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h5 class="modal-title text-primary"><span class="material-icons icon">settings</span>회원 로그인</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button> <!--dismiss : 창 닫기-->
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<div class="row">
						<div class="col">
							<input type="text" name="id" class="form-control" placeholder="아이디">
						</div>
					</div>
					<div class="row">
						<div class="col">
							<input type="password" name="pw" class="form-control" placeholder="비밀번호">
						</div>
					</div>
				</div>
		
				<!-- Modal footer -->
				<div class="modal-footer">
					<!-- 로그인, 찾기, 가입 버튼 세개 만들기-->
					<button type="button" class="btn btn-primary"><span class="material-icons icon">login</span><span class="d-none d-md-inline-block">로그인</span></button>
					<button type="button" class="btn btn-primary"><span class="material-icons icon">search</span><span class="d-none d-md-inline-block">찾기</span></button>
					<button type="button" class="btn btn-primary"><span class="material-icons icon">assignment_ind</span><span class="d-none d-md-inline-block">회원가입</span></button>

					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
				</div>

			</div>
		</div>
	</div> <!-- The Modal -->

</div> <!--Container-->
