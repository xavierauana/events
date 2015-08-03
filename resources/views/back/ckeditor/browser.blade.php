<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h3>testing</h3>
    <table>
        @foreach($medias as $media)
            <tr>
                <td><input type="checkbox" data-id="{{$media->id}}"/></td>
                @if(preg_match('/^image/i', $media->type))
                    <td><img style="width:200px" src="{{$media->link}}" alt="" /> </td>
                @elseif(preg_match('/^video/i', $media->type))
                    <td>
                        <video src="{{$media->link}}" controls style="width:200px"></video>
                    </td>
                @endif
                <td>{{$media->type}}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>