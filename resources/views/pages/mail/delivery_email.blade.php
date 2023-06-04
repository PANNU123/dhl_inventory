<div class="card">
    <div class="card-header">
        Hello! {{$data['name']}}
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <p>{{ $data['message'] }}</p>
            {{--            <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>--}}
        </blockquote>
    </div>
</div>
