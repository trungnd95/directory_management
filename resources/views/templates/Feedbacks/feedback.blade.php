@extends('templates.Layouts.master')

@section('templates.head.title','Feedback')
@section('templates.body.headTitle')
<p class="text-center">Feedback</p>
@endsection
	
@section('templates.body.content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="box box-primary">
        <!-- form start -->
        <form role="form" action="{{ route('guest.sendFeedback')}}" method="post" >
          {{ csrf_field()}}
          <div class="box-body">
            
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" id="email"  placeholder="Your email" required />
            </div>
            <div class="form-group">
            	<label>Content</label>
            	<textarea name="feedback" class="feedback form-control" placeholder="Something give us" rows="15" cols="100" required></textarea>
            </div>
            
         </div><!-- /.box-body -->

         <div class="box-footer">
          <button type="submit" class="btn btn-primary  col-md-2">Add</button>
        </div><!--/end box-footer -->
      </form><!--/end form -->
    </div><!-- /.box -->
  
  </div>
</div>
@endsection