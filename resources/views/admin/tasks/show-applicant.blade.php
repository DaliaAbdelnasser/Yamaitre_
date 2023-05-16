<div class="row">
@foreach ($lawyers as $lawyer)
                <tr>
                    <td><img src="{{ asset('uploads/' . $lawyer->userable->profile_image) }}" width="50" height="40"
                        alt="" style="border-radius: 50%"/>
                        
                    </td>
                    <td>{{ $lawyer->name }}</td>
                    <td>{{ $lawyer->email }}</td>
                    <td>{{ $lawyer->phone }}</td>
                    <td>{{ $lawyer->userable->governorates }}</td>
                </tr>
            @endforeach
    <div class="col-xs-6 col-md-4"><img src="{{ asset('uploads/' .  $task->user->first()->userable->profile_image) }}" width="200" height="200"
                    alt="" style="border-radius:50%"/>
    </div>
    <div class="col-xs-6 col-md-8" style="font-size:1.2em">
        <label for="name">Name :</label>
        <label id="name">{{ $task->lawyers->first()->user->first_name }}</label>
        <hr>
        <label for="phone">Phone :</label>
        <label id="phone">{{ $task->lawyers->first()->user->phone }}</label>
        <hr>
        <label for="email">Email :</label>
        <label id="email">{{ $task->lawyers->first()->user->email }}</label>
        <hr>
        <label for="governorate">Governorates :</label>
        <label id="governorate">{{ $task->lawyers->first()->governorates }}</label>
        <hr>
        <label for="court">Court Name :</label>
        <label id="court">{{ $task->lawyers->first()->court_name }}</label>
        <hr>
        <label for="discription">Discription :</label>
        <label id="discription">{{ $task->lawyers->first()->description }}</label>
    </div>
</div>







