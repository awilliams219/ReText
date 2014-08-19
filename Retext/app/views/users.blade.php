@extends('root')

@section('Canvas')

<table class="UserTable">
    <thead class="UserTableHead">
        <tr class="UserTableHeadTR">
            <th class="UserTableTH">
                Username
            </th>
            <th class="UserTableTH">
                Rights
            </th>
        </tr>
    </thead>
    <tbody class="UserTableBody">
        @forelse ($users as $user)
            <tr class="UserTableRow" onMouseOver="enableX({{ $user->id }});" onMouseOut="disableX({{ $user->id }});">
                <td class="User">
                    <span id="user_{{ $user->id }}">{{ $user->username }}</span>
                </td>
                <td class="Permissions">
                    @if ($user->administrator)
                        ADMIN 
                    @endif
                    @if ($user->can_delete)
                        DELETE
                    @endif
                    @if ($user->can_add)
                        SUBMIT
                    @endif
                    <div class="DeleteX Hidden" id="DeleteX_{{ $user->id }}">
                        <a href="#" class="DeleteLink" onClick="confirmDelete({{ $user->id }}, '{{$user->username}}'); return false;">X</a>
                    </div>
                </td>
            </tr>
        @empty
            <tr class="UserTableEmpty">
                <td colspan="2" class="NoUsers">
                    There are currently no registered users.  Please re-seed the users table.
                </td>
            </tr>
        @endforelse
    </tbody>
    <tfoot class="UserTableFooter">
        <tr class="UserTableFootTR">
            <td class="UserTableFootTD">
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addModal">Add User</button>
            </td>
            <td class="UserTableFootTd"></td>
        </tr>
    </tfoot>
</table>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" ara-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ URL::action('UserController@postAdd') }}" id="addForm" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span area-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="addModalLabel">Add New User Account</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token(); }}" />
                    <table class="addTable">
                        <tr>
                            <td class="addCell">
                                <label for="usernameField">Username</label>
                                <input type="text" name="username" size="20" id="usernameField"/>
                            </td>
                            <td>
                                <label for="passwordField">Password</label>
                                <input type="password" name="password" id="passwordField" /><br />
                            </td>
                            <td class="addCell">
                                <label for="passwordConfirmField">Confirm Password</label>
                                <input type="password" name="passwordConfirm" id="passwordConfirmField" />
                            </td>
                        </tr>
                        <tr>
                            <td class="addCell">
                                <label for="canAddBox">Can Add Keywords</label>
                                <input type="checkbox" value="1" name="can_add" id="canAddBox" />
                            </td>
                            <td class="addCell">
                                <label for="canDeleteBox">Can Delete Keywords</label>
                                <input type="checkbox" value="1" name="can_delete" id="canDeleteBox" />
                            </td>
                            <td>
                                <label for="adminBox">Administrator</label>
                                <input type="checkbox" value="1" name="admin" id="adminBox" />
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onClick="addForm.submit()">Save New User</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" ara-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ URL::action('UserController@postDelete') }}" id="deleteForm" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span area-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="addModalLabel">Confirm Deletion</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token(); }}" />
                    <input type="hidden" name="id" id="deleteID" />
                    <h3>Are you sure you wish to delete "<span class="User" id="deleteText"></span>"?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onClick="deleteForm.submit()">Delete User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

