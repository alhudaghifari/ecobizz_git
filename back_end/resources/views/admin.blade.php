@extends('layouts.app')

@section('content')
	<link rel="stylesheet" href="{{asset('css/admin.css')}}" type="text/css">

	<section class="admin-section1">
		<div id="admin">
			Halaman Admin
		</div>
	</section>

	{{-- Ini Error --}}
	@if (session()->has('success'))
		@if (session()->get('success'))
			<h1>{{session()->get('message')}}</h1><br>
		@else
			@foreach (session()->get('errors')->all() as $error)
				{{$error}}<br>
			@endforeach
		@endif
	@endif

	<section class="admin-section2">
		<div class="container">
			<div id="left">
				<div class="section-title">
					Kelola Forum<br>
				</div>

				<div class="section-content">
					<table>
						<col width="210">
						<col width="200">
						<col width="200">
						@foreach ($forums as $forum)
							<tr>
								<td align="justify">
									<b>{{$forum->name}}</b>
								</td>
								<td align="center"><button onclick="window.location.href='/admin?forumId={{$forum->id}}'">Edit</button></td>
								<td align="center"><button onclick="window.location.href='/admin/delete?forumId={{$forum->id}}'">Hapus</button></td>
							</tr>
						@endforeach
					</table><br>
					{!! Form::open(['method' => 'post', 'url' => url('admin')]) !!}
					@if ($forum = \App\Forum::find($forumId))
						Edit Forum<br>
						<input type="text" name="judul" placeholder="Judul" value="{{$forum->name}}"><br>
						<input type="text" name="deskripsi" placeholder="Deskripsi" value="{{$forum->description}}"><br>
						<input type="hidden" name="forumId" value={{$forumId}}>
						<button class="button1" style="float: right;">Edit Forum</button>
					@else
						Forum Baru<br>
						<input type="text" name="judul" placeholder="Judul"><br>
						<input type="text" name="deskripsi" placeholder="Deskripsi"><br>
						<input type="hidden" name="forumId" value=-1>
						<button class="button1" style="float: right;">Tambah Forum</button>
					@endif
					{!! Form::close() !!}
					<br><br>
				</div>

				<div style="clear: both;"></div>

				<div class="section-title">
					Statistik User
				</div>
				<div class="total-user">
					Jumlah pengguna: <b>{{count(App\User::all())}}</b> orang<br><br>
					Pengguna baru hari ini: <b>{{count(App\User::newUsers())}}</b> orang<br><br>
					Jumlah pengguna per kategori: <br>
					<div style="margin-left: 20px;">
						<justify>
						@foreach ($roles as $role)
							{{$role->name}}: <b>{{count($role->users)}}</b> orang<br>
						@endforeach
							Unknown: <b> {{count(App\User::where('role_id', null))}}</b> orang<br>
						</justify>
					</div>
					<br>
				</div>
			</div>

			<div id="right">
				<div class="section-title">
					Kelola Kategori Pengguna
				</div>
				<div class="section-content">
					<table>
						<col width="210">
						<col width="200">
						<col width="200">
						@foreach ($roles as $role)
							<tr>
								<td align="justify">
									<b>{{$role->name}}</b>
								</td>
								<td align="center"><button onclick="window.location.href='/admin?categoryId={{$role->id}}'">Edit</button></td>
								<td align="center"><button onclick="window.location.href='/admin/delete?categoryId={{$role->id}}'">Hapus</button></td>
							</tr>
						@endforeach
					</table><br>
					{!! Form::open(['method' => 'post', 'url' => url('admin')]) !!}
					@if ($category = App\Role::find($categoryId))
						Edit Kategori<br>
						<input type="text" name="kategori" placeholder="Kategori" value="{{$category->name}}"><br>
						<input type="hidden" name="categoryId" value={{$categoryId}}>
						<button class="button1" style="float: right;">Edit Kategori</button>
					@else
						Kategori Baru<br>
						<input type="text" name="kategori" placeholder="Kategori"><br>
						<input type="hidden" name="categoryId" value=-1>
						<button class="button1" style="float: right;">Tambah Kategori</button>
					@endif
					{!! Form::close() !!}
					<br><br>
				</div>
				<div class="section-title">
					Export Data User
				</div>
				<div class="section-content">
					<button class="button1">XLSX</button>
					<button class="button1">CSV</button>
				</div>
				<div class="section-title">
					Import Data User
				</div>
				<div class="section-content">
					<button class="button1">XLSX</button>
					<button class="button1">CSV</button>
				</div>
			</div>
		</div>



	</section>

@endsection
