<div class="box">
    <div class="box-header">
        <h3 class="box-title">List Films {{$getMonth->month}} Month </h3>
    </div>
    <!-- /.box-header -->
    <button type="button" class="editor_create btn btn-info btn-lg" data-toggle="modal" data-target="#ModalFim">New Film</button>

    <div class="modal fade" id="ModalFim" role="dialog">
        <form id="FormFilm" action="{{route('admin.vote_value.create')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" value="{{$idRead}}" id="vote_id" name="vote_id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title titleOK">Create Film</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr">Name:</label>
                            <input type="text" name="name" placeholder="Name film..." required class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="usr">Link:</label>
                            <input type="url" name="link" placeholder="Url film..." required class="form-control" id="link">
                        </div>
                        <div class="form-group">
                            <label for="usr">Start time:</label>
                            <input type="datetime-local" name="start_time" placeholder="Start time..." required class="form-control" id="start_time">
                        </div>
                        <div class="form-group">
                            <label for="usr">Address:</label>
                            <input type="text" name="address" placeholder="Address..." required class="form-control" id="address">
                        </div>
                        <div class="form-group">
                            <label for="usr">Image:</label>
                            <input type="file" name="image"  required class="form-control" id="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-default BTNSubmit BTNcreate">Create</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped text-center" >
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Start time</th>
                <th>Address</th>
                <th>Link review</th>
                <th>Option</th>
            </tr>
            </thead>
            <tbody>
            @foreach($detailReads as $getFim)
                <tr>
                    <td>{{$getFim->id}}</td>
                    <td>{{$getFim->name}}</td>
                    <td><img style="max-width: 100px; max-height: 50px" src="/storage/images/{{$getFim->image}}"/></td>
                    <td>{{$getFim->start_time}}</td>
                    <td>{{$getFim->address}}</td>
                    <td><a href="{{$getFim->link}}" target="_blank">{{$getFim->link}}</a></td>
                    <td>
                        {{--{{route('admin.vote_value.edit',$getFim->id)}}--}}
                        <a href="{{route('admin.vote_value.edit',$getFim->id)}}"  title="Edit"  >
                            <i class="fa fa-edit"></i>
                        </a> |
                        <a href="{{route('admin.vote_value.destroy',$getFim->id)}}" onclick=" return confirm('Are you sure to delete this item?');" title="Delete">
                            <i class="fa fa-dropbox"></i>
                        </a>
                    </td>
                </tr>
                <div class="modal fade" id="my-{{$getFim->id}}" role="dialog" >
                    <form id="ValuesForm" action="{{route('admin.vote_value.update',$getFim->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" id="id" name="id" value="{{$getFim->id}}">
                        <input type="hidden" value="{{$idRead}}" id="vote_id" name="vote_id">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit film</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="usr">Name:</label>
                                        <input type="text" name="name" placeholder="Name film..." value="{{$getFim->name}}" required class="form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label>Link:</label>
                                        <input type="url" name="link" placeholder="Url film..." value="{{$getFim->link}}" required class="form-control" id="link">
                                    </div>
                                    <div class="form-group">
                                        <label >Image:</label>
                                        <img style="max-width: 300px; max-height: 400px; min-width: 200px; min-height: 300px" src="/storage/images/{{$getFim->image}}">
                                    </div>
                                    <div class="form-group">
                                        <label >Image:</label>
                                        <input type="file" name="image"  class="form-control" id="image">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-default" name="Update"  onclick=""/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach


            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
