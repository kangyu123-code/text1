<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form style="margin-left: 200px" action="{{route('admin.user.role',$user)}}" method="post">
	@csrf
@include('admin.common.validate')
	@foreach($roleall as $item)
	<label>{{$item->name}}</label>

	<input type="radio" name="role_id" value="{{$item->id}}"
	@if($item->id==$user->role_id)checked="checked" @endif
	>
	@endforeach
	<button type="submit">提交</button>
</form>
</body>
</html>