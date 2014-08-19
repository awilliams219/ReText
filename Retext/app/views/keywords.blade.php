@extends('root')

@section('JSLoader')
    {{ HTML::script('js/keywords.js'); }}
@stop

@section('Canvas')
<div class="TableWrap">
    <table class="KeywordTable">
        <thead class="KeywordTableHead">
            <tr class="KeywordTableHeadTR">
                <th class="KeywordTableTH">
                    Keyword
                </th>
                <th class="KeywordTableTH">
                    URL Target
                </th>
            </tr>
        </thead>
        <tbody class="KeywordTableBody">
            @forelse ($keywords as $keyword)
                <tr class="KeywordTableRow" onMouseOver="enableX({{ $keyword->id }});" onMouseOut="disableX({{ $keyword->id }});">
                    <td class="Keyword TableEntry">
                        <span id="keyword_{{ $keyword->id }}">{{ $keyword->keyword }}</span>
                    </td>
                    <td class="URL TableEntry">
                        {{ $keyword->url }}
                        <div class="DeleteX Hidden" id="DeleteX_{{ $keyword->id }}">
                            <a href="#" class="DeleteLink" onClick="confirmDelete({{ $keyword->id }}, '{{$keyword->keyword}}'); return false;">X</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr class="KeywordTableEmpty">
                    <td colspan="2" class="NoKeywords">
                        There are currently no registered keywords
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="TableFoot">    
    <table class="KeywordTableFooter">
        <tr class="KeywordTableFootTR">
            <td class="KeywordTableFootTD">
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addModal">Add Keyword</button>
            </td>
            <td class="KeywordTableFootTd"></td>
        </tr>
    </table>
</div>


<div class="modal fade" id="addModal" tabindex="-1" role="dialog" ara-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ URL::action('KeywordController@postAdd') }}" id="addForm" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span area-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="addModalLabel">Add New Keyword Relation</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token(); }}" />
                    <table class="addTable">
                        <tr>
                            <td class="addCell">
                                <label for="keywordField">Keyword</label>
                                <input type="text" name="keyword" size="30" id='keywordField' />
                            </td>
                            <td>
                                <label for="urlField">URL</label>
                                <input type="text" name="url" size="60" id='urlField' />
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onClick="validateNewKeyword()">Save New Keyword</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" ara-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ URL::action('KeywordController@postDelete') }}" id="deleteForm" >
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
                    <h3>Are you sure you wish to delete "<span class="Keyword" id="deleteText"></span>"?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onClick="deleteForm.submit()">Delete Keyword</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

