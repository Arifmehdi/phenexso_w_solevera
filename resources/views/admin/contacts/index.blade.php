@extends('admin.master')

@section('title', 'Admin Dashboard | Contact Messages')

@section('body')
<section class="content py-3">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="card w3-round shadow-lg">

                <!-- Card Header -->
                <div class="card-header pl-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-2">
                        <i class="fas fa-envelope text-primary"></i> All Contact Messages
                    </h3>
                </div>

                <!-- Card Body -->
                <div class="card-body bg-light px-0 pb-0 pt-2">
                    <div class="col-sm-12">
                        <div class="table-responsive table-responsive-sm">
                            <table class="table-striped table-bordered table-hover table-sm mb-1 table">
                                <thead class="text-muted thead-light">
                                    <tr>
                                        <th style="width: 10px">#SL</th>
                                        <th style="width: 80px">Action</th>
                                        <!-- <th>ID</th> -->
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Received At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = (($contacts->currentPage() - 1) * $contacts->perPage() + 1); @endphp
                                    @foreach($contacts as $contact)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink{{ $contact->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                    </a>

                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink{{ $contact->id }}">
                                                        <a href="{{ route('admin.contacts.show', $contact->id) }}" class="dropdown-item">
                                                            <i class="fa fa-eye"></i> View
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- <td>{{ $contact->id }}</td> -->
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->subject }}</td>
                                            <td>{{ $contact->created_at->format('d/m/Y h:i A') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="w3-small float-right pt-1">
                            {!! $contacts->links() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
