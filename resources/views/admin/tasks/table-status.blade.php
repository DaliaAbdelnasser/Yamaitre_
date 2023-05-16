<div class="table-responsive-sm">
    <table class="table table-striped" id="tasks-table">
        <thead style="font-size:1.2em">
            <tr>
                <th>Lawyer</th>
                <th>Title</th>
                <th>Price</th>
                <th>Court</th>
                <th>Governorates</th>
                <th>Status</th>
                <th>Starting Date</th>
                <th>Description</th>
                @if($tasks[0]->status == 'inreview')
                <th>Task File</th>
                @endif
            </tr>
        </thead>
        {{-- <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>
                    <img src="{{ asset('uploads/' . $task->assignedlawyers->first()->userable->profile_image) }}" width="50" height="40"
                        alt="" style="border-radius: 50%"/>
                        <br>
                        <label>{{ $task->assignedlawyers->first()->userable->first_name }}</label>
                    </td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->price }}</td>
                    <td>{{ $task->court }}</td>
                    <td>{{ $task->governorates }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->starting_date }}</td>
                    <td>{{ $task->description }}</td>
                    @if($task->status == 'inreview')
                       <td><a href="asset('uploads/' . $task->task_file) }}">{{ $task->task_file }}</a></td>
                    @endif
                </tr>
            @endforeach
        </tbody> --}}
    </table>
</div>
