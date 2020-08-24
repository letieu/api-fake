    <td > {{ @$api['id'] }}</td>
    <td scope="row">
        <input class="edit-entry form-control"  id="edit-entry" value="{{$api['entry']}}">
    </td>

    <td class="json" style="display: flex;flex-direction: column;justify-content: center">
                        <textarea  class="form-control" rows="10" cols="20" id="edit-data">{{ @$api['data'] }}</textarea>
                        <button  class="btn-success" onclick="generate()">format</button>
    </td>
    <td>
        <select class="form-control watch" id="edit-method" name="method">
            <option value="post">Post</option>
            <option value="get">Get</option>
            <option value="put">Put</option>
            <option value="path">Path</option>
            <option value="delete">Delete</option>

        </select>
    </td>
    <td>
        <button type="button" class="btn btn-warning" onclick="save({{@$api['id']}})">Save</button>
    </td>

<script>


    function generate() {
        var parameters = document.getElementById('edit-data');
        console.log(parameters)

        var output = document.getElementById('edit-data');

        var input = parameters.value;

        try {
            output.value = JSON.stringify(JSON.parse(input), undefined, '\t');
        } catch (e) {
            console.log(e);
        }
    }

</script>



