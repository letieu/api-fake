@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" action="{{ route('api.store') }}" class="row" >
            @csrf
            <div class="col-6">
                <div class="form-group">
                    <label for="entry">Entry point</label>
                    <input type="text" class="form-control watch" id="entry"  name="entry" placeholder="EX: articles/top">
                </div>
                <div class="alert alert-success"  role="alert">
                    <span class="text-danger"><span> {{request()->getSchemeAndHttpHost()}}/</span><span>{{session('user')->github_id}}/</span></span><span id="entry_view"></span>

                </div>
                <div class="form-group">
                    <label for="method">Method</label>

                    <select class="form-control watch" id="method" name="method">
                        <option value="post">Post</option>
                        <option value="get">Get</option>
                        <option value="put">Put</option>
                        <option value="path">Path</option>
                        <option value="delete">Delete</option>


                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="data">Data ( json only)</label>
                    <textarea id="data" name="data" class="form-control watch" rows="8"></textarea>
                </div>
            </div>

            <div class="form-group col-12">
                <button type="submit" class="btn btn-primary container-fluid ">Submit</button>
            </div>
        </form>

    @if($apis->isEmpty() )
        <h2> No have one </h2>
    @else
            <div class="alert alert-secondary m-5" role="alert">
                <h5 class="text-center">your api root:
                    <span class="text-danger"><span>{{request()->getSchemeAndHttpHost()}}/</span><span>{{session('user')->github_id}}/</span></span>
                </h5>
            </div>


        <table class="table  table-striped table-bordered" style="margin-top: 100px ">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Entry</th>
                <th scope="col" style="width: 50%">Data</th>
                <th scope="col">Method</th>
                <th scope="col">Action</th>

            </tr>
            </thead>
            <tbody>

            @foreach(@$apis as $api)

                <tr id="{{$api['id']}}" class="api-row" >
                    <th scope="row">{{ @$api['id'] }}</th>
                    <td class="entry">{{ @$api['entry'] }}</td>
                    <td class="data">
                        <textarea class="form-control" style="border: none; outline: none; ">{{ @$api['data'] }}</textarea>
                    </td >
                    <td class="method">{{ @$api['method'] }}</td>
                    <td>
                        <button type="button" onclick="showEdit({{@$api['id']}})" class="api-edit btn btn-success">edit</button>
                        <button type="button" onclick="remove({{@$api['id']}} )" class="api-delete btn btn-danger">delete</button>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
            <button type="button" onclick="discard()" id='dis' class="btn btn-warning" style="position: fixed; right: 20px;top:50%; box-shadow: 2px 5px 5px gray;display: none">Discard</button>

        @endif
        <div id="bot"></div>
    </div>

@endsection

@section('scripts')
    <script>
        let editing ;
        let editingData ;

        function remove(apiId) {
            let row =  $(`.api-row#${apiId}`);
            row.hide();

            axios.delete(`api/${apiId}`)
        }

        function save(id) {
            $('#dis').hide();

            axios.put(`api/${id}`, {
                entry: $('#edit-entry').val(),
                method: $('#edit-method').val(),
                data: $('#edit-data').val()
            }).then(res=>{
                hideEdit();
                console.log( $(`#${id}`).find('.entry'))
                $(`#${id}`).find('.entry').text(res.data.entry)
                $(`#${id}`).find('.method').text(res.data.method)
                $(`#${id}`).find('.data textarea').text(res.data.data)

            })
        }

        function discard() {
            hideEdit();
            $('#dis').hide();
        }
        function showEdit(apiId) {
            hideEdit( editing);
            editing = apiId;
            let row =  $(`.api-row#${apiId}`);
            $('#dis').show();
            axios.get(`api/${apiId}/edit`)
                .then(res=>{
                    editingData = row.html();
                    row.html(res.data)
                    console.log('la ');
                })
                .catch(err=>console.log(err));
        }

        function hideEdit(){
            if (!editing) return ;
            let row =  $(`.api-row#${editing}`);
            row.html(editingData)

            editing = false;

        }

        $(document).ready(function () {
            console.log('ok');
            $('#entry').change(function (event) {
                $('#entry_view').html(event.target.value)
            })


        })

    </script>
@endsection
