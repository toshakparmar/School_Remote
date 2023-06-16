<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    // use MediaUploadingTrait;
    // use CsvImportTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            if(auth()->user()->roles[0]->id == 5){
                $query = User::with(['roles'])
                    ->join('role_user','role_user.user_id','=','users.id')
                    ->whereIn('role_id',[3])
                    ->get();          
            } else {
                $query = User::with(['roles'])->get();
            }
            
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
                $crudRoutePart = 'users';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->editColumn('approved', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->approved ? 'checked' : null) . '>';
            });
            $table->editColumn('verified', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->verified ? 'checked' : null) . '>';
            });
            $table->editColumn('roles', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });
            // $table->editColumn('identity_proof', function ($row) {
            //     if (!$row->identity_proof) {
            //         return '';
            //     }
            //     $links = [];
            //     foreach ($row->identity_proof as $media) {
            //         $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
            //     }

            //     return implode(' ', $links);
            // });
            // $table->editColumn('address_proof', function ($row) {
            //     if (!$row->address_proof) {
            //         return '';
            //     }
            //     $links = [];
            //     foreach ($row->address_proof as $media) {
            //         $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
            //     }

            //     return implode(' ', $links);
            // });
            // $table->editColumn('passport_size_photo', function ($row) {
            //     if ($photo = $row->passport_size_photo) {
            //         return sprintf(
            //             '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
            //             $photo->url,
            //             $photo->thumbnail
            //         );
            //     }

            //     return '';
            // });
            // $table->editColumn('department', function ($row) {
            //     $labels = [];
            //     foreach ($row->departments as $department) {
            //         $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $department->name);
            //     }

            //     return implode(' ', $labels);
            // });

            $table->editColumn('login_date', function ($row) {
                return $row->login_date ? date('H:i', strtotime($row->login_date)) : '';
            });
            $table->editColumn('logout_date', function ($row) {
                return $row->logout_date ? date('H:i', strtotime($row->logout_date)) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'approved', 'verified', 'roles', 'identity_proof', 'address_proof', 'passport_size_photo', 'department']);

            return $table->make(true);
        }

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        // $departments = Department::pluck('name', 'id');

        // $teams = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $storeUserRequest)
    {
        $user = User::create($storeUserRequest->all());
        $user->roles()->sync($storeUserRequest->input('roles', []));

        // $user->departments()->sync($storeUserRequest->input('departments', []));
        // foreach ($storeUserRequest->input('identity_proof', []) as $file) {
        //     $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('identity_proof');
        // }

        // foreach ($storeUserRequest->input('address_proof', []) as $file) {
        //     $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('address_proof');
        // }

        // if ($storeUserRequest->input('passport_size_photo', false)) {
        //     $user->addMedia(storage_path('tmp/uploads/' . basename($storeUserRequest->input('passport_size_photo'))))->toMediaCollection('passport_size_photo');
        // }

        // if ($media = $storeUserRequest->input('ck-media', false)) {
        //     Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        // }

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        // $departments = Department::pluck('name', 'id');

        // $teams = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $updateUserRequest, User $user)
    {
        $user->update($updateUserRequest->all());
        $user->roles()->sync($updateUserRequest->input('roles', []));
        // $user->departments()->sync($updateUserRequest->input('departments', []));
        // if (count($user->identity_proof) > 0) {
        //     foreach ($user->identity_proof as $media) {
        //         if (!in_array($media->file_name, $updateUserRequest->input('identity_proof', []))) {
        //             $media->delete();
        //         }
        //     }
        // }
        // $media = $user->identity_proof->pluck('file_name')->toArray();
        // foreach ($updateUserRequest->input('identity_proof', []) as $file) {
        //     if (count($media) === 0 || !in_array($file, $media)) {
        //         $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('identity_proof');
        //     }
        // }

        // if (count($user->address_proof) > 0) {
        //     foreach ($user->address_proof as $media) {
        //         if (!in_array($media->file_name, $updateUserRequest->input('address_proof', []))) {
        //             $media->delete();
        //         }
        //     }
        // }
        // $media = $user->address_proof->pluck('file_name')->toArray();
        // foreach ($updateUserRequest->input('address_proof', []) as $file) {
        //     if (count($media) === 0 || !in_array($file, $media)) {
        //         $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('address_proof');
        //     }
        // }

        // if ($request->input('passport_size_photo', false)) {
        //     if (!$user->passport_size_photo || $updateUserRequest->input('passport_size_photo') !== $user->passport_size_photo->file_name) {
        //         if ($user->passport_size_photo) {
        //             $user->passport_size_photo->delete();
        //         }
        //         $user->addMedia(storage_path('tmp/uploads/' . basename($updateUserRequest->input('passport_size_photo'))))->toMediaCollection('passport_size_photo');
        //     }
        // } elseif ($user->passport_size_photo) {
        //     $user->passport_size_photo->delete();
        // }

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_create') && Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
