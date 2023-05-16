<div class="row">
    <div class="col-xs-6 col-md-4"><img src="{{ asset('uploads/' . $distress->users->first()->userable->profile_image) }}" width="200" height="200"
                    alt="" />
    </div>
    <div class="col-xs-6 col-md-8" style="font-size:1.2em">
        <label for="title">Sos Type :</label>
        <label id="title">{{ $distress->type }}</label>
        <hr>
        <label for="author_name">Sos Governorates :</label>
        <label id="author_name">{{ $distress->governorate }}</label>
        <hr>
        <label for="created_at">Description :</label>
        <label id="created_at">{{ $distress->description }}</label>
        <hr>
        <label for="description">Sos Date :</label>
        <label id="description">{{ $distress->created_at }}</label>
        <hr>
        <label for="description">Name :</label>
        <label id="description">{{ $distress->users->first()->first_name }}</label>
        <hr>
        <label for="description">Phone :</label>
        <label id="description">{{ $distress->users->first()->phone }}</label>
        <hr>
        <label for="description">Email :</label>
        <label id="description">{{ $distress->users->first()->email }}</label>
        <hr>
    </div>
</div>







