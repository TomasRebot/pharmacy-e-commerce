<?php
namespace App\Core\DynamicTableResources;
use App\Core\Entities\BaseTableResource;
use App\Core\Interfaces\ResourceTableInterface;

use App\Entities\User;
use Illuminate\Http\Request;


class UserTableResource extends BaseTableResource implements ResourceTableInterface
{



    public function getResource(){

        return [
            'page_name' => 'Usuarios panel',
            'permissions' => permissionsTo($this->current_form),
            'resource' => 'User',
            'resolver' => 'UserResolver',

            'url' =>route('api.dynamic.table'),
            'createUrl' =>route('users.create'),
            'editUrl' => route('users.edit', ['user' => 'User']),

            'deleteUrl' => route('bulk-delete'),
            'deleteLabel' => 'Eliminar',
            'deleteModalQuestion' => '¿Esta seguro que desea eliminar este usuario?',

            'restoreUrl' => route('bulk-delete'),
            'restoreLabel' => 'Restaurar',
            'restoreModalQuestion' =>'¿ Esta seguro que desea restaurar este usuario?',

            'perPage' => 10,
            'perPageLabel' => 'Usuarios por página',
            'filters' => ['name', 'email', 'role_list'],
            'emptyTableLabel' => 'No se encontraron registros'
        ];
    }

    public function handle(Request $request)
    {
        $columns = collect([
            ["label" => 'Nombre', "field" => 'name', ],
            ["label" => 'Email',"field" => 'email'],
            ["label" => 'Roles',"field" => 'role_list'],
            ["label" => 'Estado',"field" => 'state'],
        ]);

        $query = new User();
        $query = $this->filter($query, $request);
        $query = $this->sort($query, $request);
        $data = $query->forCurrentUser()->paginate($request->per_page)->appends(['sort' => $request->sort]);
        $data->each(function($user){
                $user['role_list'] = $user->roleStringList;
        });

        return [
            'paginator' =>$data ,
            'columns' => $columns,
            'filters'=> $request->columnFilters,
            'request' => $request->all()
        ];
    }

    public function sort($query, $request)
    {
        $sort = $request->sort;
        $field = ($sort['field'] != '') ? $sort['field'] : null;
        $type = ($sort['type'] != '') ? $sort['type'] : null;
        if(isset($sort['type']) && isset($sort['field']) && !is_null($field) && !is_null($type))
        {
            switch ($sort['field']){
                case'role_list':
                    //do nothing
                    break;
                default:
                    $query = $query->orderBy($field, $type);
                    break;
            }
        }
        return $query;
    }

    public function filter($query,$request)
    {
        if(isset($request->columnFilters) && count($request->columnFilters)){
            foreach($request->columnFilters as $key =>  $filter){
                switch ($filter){
                    case'role_list':
                        $query = $query->orwhereHas('roles', function($role) use($request) {
                            $role->where('name', 'LIKE', '%'.$request->search_query.'%');
                        });
                        break;
                    default:
                        $query = $query->orWhere($filter, 'LIKE', '%'.$request->search_query.'%');
                        break;
                }
            }
        }
        return $query;
    }
}
