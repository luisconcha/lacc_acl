@if($errors->any())
    <div role="alert" class="alert alert-danger alert-dismissible fade in">
        <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
        </button>
        <h4>Ups! An error occurred!</h4>
        <h45>In the following list you can check errors</h45>

        <ul class="alert">
            @foreach($errors->all() as $erro)
                <li><strong>{{ $erro }}</strong></li>
            @endforeach
        </ul>
    </div>
@endif