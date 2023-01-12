<div class="row">
    <div class="container">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Role</th>
                <th scope="col">Permissions</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-nowrap">
                        <?php 
                            $permissions = [];    
                        ?>
                        @foreach ($entry->roles as $key => $role)
                            <p><span class="btn btn-sm btn-primary font-weight-bold">{{$role->name}}</span></p>
                            @foreach ($role->permissions as $permission)
                                <?php 
                                    if(!in_array($permission->name, $permissions)){
                                        $permissions[] = $permission->name;
                                    }
                                ?>
                            @endforeach
                        @endforeach
                    </td>
                    <td>
                        @foreach ($permissions as $permission)
                            <span class="btn btn-sm btn-success mb-2">{{$permission}}</span>
                        @endforeach
                    </td>
                </tr>
            </tbody>  
        </table>
    </div>
</div>