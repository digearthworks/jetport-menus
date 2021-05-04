@if(session('confirm'))
<script>
    if(!confirm("{{session('confirm')}}")){
        window.history.go(-1);
    }
</script>
@endif

@if(session('alert'))
<script>
    alert("{{session('alert')}}");
</script>
@endif

@if(count($errors) > 0)

@foreach($errors->all() as $error)
<div class="bstrap4-iso">
    <div class="alert alert-danger">
        {{$error}}
    </div>
</div>
@endforeach


@endif

@if(session('success'))
<div class="bstrap4-iso">
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>{{session('success')}}</strong>
    </div>
</div>
@endif

@if(session('error'))
<div class="bstrap4-iso">
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong> {{session('error')}}</strong>
    </div>
</div>
@endif


@if(isset($message))
<div class="bstrap4-iso">
    <div class="alert {!! $message->alert?? 'alert-secondary' !!} alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong> {{$message->text??''}}</strong>
    </div>
</div>
@endif