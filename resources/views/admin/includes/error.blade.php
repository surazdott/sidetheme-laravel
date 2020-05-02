@foreach($errors->all() as $error)
<div class="alert alert-danger alert-dismissable fade show alert-outline">
    <button class="close" data-dismiss="alert" aria-label="Close"></button>
    {{ $error }}
</div>
@endforeach
