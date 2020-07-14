<select name="dichvu" id="dichvu">
      @foreach($dichvu as $dv)
        <option value="{{$dv->id}}">{{$dv->tendichvu}}</option>
      @endforeach
</select>