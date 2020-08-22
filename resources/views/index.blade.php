@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" action="{{ route('api.store') }}">
            @csrf
            <div class="form-group">
                <label for="entry">Entry point</label>
                <input type="text" class="form-control watch" id="entry"  name="entry" placeholder="EX: articles/top">
            </div>
            <div class="alert alert-success"  role="alert">
                <span class="text-danger"><span>{{env('APP_URL')}}/</span><span>{{session('user')->github_id}}/</span></span><span id="entry_view"></span>

            </div>
            <div class="form-group">
                <label for="data">Data ( json only)</label>
                <textarea id="data" name="data" class="form-control watch" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="data">Method</label>

                <select class="form-control watch" id="method" name="method">
                    <option value="post">Post</option>
                    <option value="get">Get</option>

                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    @if($apis->isEmpty() )
        <h2> No have one </h2>
    @else
            <div class="alert alert-secondary m-5" role="alert">
                <h5 class="text-center">your api root:
                    <span class="text-danger"><span>{{env('APP_URL')}}/</span><span>{{session('user')->github_id}}/</span></span>
                </h5>
            </div>


        <table class="table" style="margin-top: 100px">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Entry</th>
                <th scope="col">Data</th>
                <th scope="col">Method</th>

            </tr>
            </thead>
            <tbody>

            @foreach(@$apis as $api)
                <tr>
                    <th scope="row">{{ @$api['id'] }}</th>
                    <td > {{ @$api['entry'] }}</td>
                    <td>
                        <textarea rows="3">
                            {{ @$api['data'] }}
                        </textarea>
                    </td>
                    <td>{{ @$api['method'] }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    @endif

    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            console.log('ok');
            $('#entry').change(function (event) {
                $('#entry_view').html(event.target.value)
            })
        })

    </script>
@endsection
