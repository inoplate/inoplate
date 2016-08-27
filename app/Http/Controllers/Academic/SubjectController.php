<?php

namespace App\Http\Controllers\Academic;

use App\Academic\Subject;
use Inoplate\Foundation\Http\Controllers\Controller;
use Roseffendi\Dales\Dales;
use Roseffendi\Authis\Authis;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $authis;

    public function __construct(Authis $authis)
    {
        $this->authis = $authis;
    }

    public function index()
    {
        $actions['active'] = [];
        $actions['trashed'] = [];

        if($this->authis->check('admin.academic.subject.create')) {
            $actions['active'][] = 'create';
        }

        if($this->authis->check('admin.academic.subject.destroy')) {
            $actions['active'][] = 'delete';
        }

        return view('academic.subject.index', compact('actions'));
    }

    public function datatables(Dales $dales)
    {
        $subject = new Subject;
        $subject->setDTModel(Subject::with('program'));

        return $dales->setDTDataProvider($subject)
                     ->addColumn('program', function($data) {
                        return $data['program']['name'];
                     })
                     ->addColumn('sks', function($data) {
                        return $data['sks_tm'] + $data['sks_p'] + $data['sks_pl'] + $data['sks_s'];
                     })
                     ->setValue('type', function($value) {
                        switch ($value['type']) {
                            case 'w':
                                return 'Wajib';
                                break;
                            case 'wp':
                                return 'Wajib pilihan';
                                break;
                            case 'pp':
                                return 'Pilihan peminatan';
                                break;
                            case 'ta':
                                return 'Tugas akhir/Skripsi/Tesis/Disertasi';
                                break;
                            default:
                                return $value['type'];
                                break;
                        }
                     })
                     ->setValue('`group`', function($value) {
                        switch ($value['group']) {
                            case 'mpk':
                                return 'MPK - Pengembangan Kepribadian';
                                break;
                            case 'mkk':
                                return 'MKK - Keilmuan dan Ketrampilan';
                                break;
                            case 'mkb':
                                return 'MKB - Keahlian Berkarya';
                                break;
                            case 'mpb':
                                return 'MPB - Perilaku Berkarya';
                                break;
                            case 'mbb':
                                return 'MBB - Berkehidupan Bermasyarakat';
                                break;
                            case 'mku':
                                return 'MKU/MKDU';
                                break;
                            case 'mkdk':
                                return 'MKDK';
                                break;
                            case 'mkk':
                                return 'MKK';
                                break;
                            default:
                                return $value['group'];
                                break;
                        }
                     })
                     ->addColumn('actions', function($data) {
                        $actions = [];

                        if($this->authis->check('admin.academic.subject.edit'))
                            $actions[] = 'update';

                        if($this->authis->check('admin.academic.subject.destroy'))
                            $actions[] = 'delete';

                        return $actions;
                     })
                     ->render();
    }

    public function search(Request $request)
    {   
        $search = $request->get('q');
        $page = $request->get('page');
        $results = Subject::where('name', 'like', '%'.$search.'%')->take($page * 5)->simplePaginate(5);

        return $results;
    }

    public function create()
    {
        return $this->getResponse('academic.subject.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|max:255|unique:subjects',
            'name' => 'required|max:255',
            'type' => 'required',
            'program_id' => 'required|exists:programs,id',
            'sks_tm' => 'numeric',
            'sks_p' => 'numeric',
            'sks_pl' => 'numeric',
            'sks_s' => 'numeric',
        ]);

        $subject = new Subject;
        $subject->code = $request->code;
        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->group = $request->group;
        $subject->program_id = $request->program_id;
        $subject->sks_tm = $request->sks_tm;
        $subject->sks_p = $request->sks_p;
        $subject->sks_pl = $request->sks_pl;
        $subject->sks_s = $request->sks_s;

        $subject->save();

        return $this->formSuccess(
            route('admin.academic.subject.index', ['id' => $subject->id]), 
            [
                'message' => 'Mata kuliah berhasil disimpan', 
                'subject' => $subject
            ]
        );
    }

    public function show(Subject $subject)
    {
        return $this->getResponse('academic.subject.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        $program = $subject->program;
        return $this->getResponse('academic.subject.edit', compact('subject', 'program'));
    }

    public function update(Request $request, Subject $subject)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'code' => 'required|max:255|unique:subjects,code,'.$subject->id,
            'type' => 'required',
            'program_id' => 'required|exists:programs,id',
            'sks_tm' => 'numeric',
            'sks_p' => 'numeric',
            'sks_pl' => 'numeric',
            'sks_s' => 'numeric',
        ]);

        $subject->code = $request->code;
        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->group = $request->group;
        $subject->program_id = $request->program_id;
        $subject->sks_tm = $request->sks_tm;
        $subject->sks_p = $request->sks_p;
        $subject->sks_pl = $request->sks_pl;
        $subject->sks_s = $request->sks_s;
        $subject->save();

        return $this->formSuccess(
            route(
                'admin.academic.subject.index'), 
                ['message' => 'Mata kuliah berhasil disimpan ', 'subject' => $subject]);
    }

    public function destroy($ids)
    {
        $ids = explode(',', $ids);

        Subject::destroy($ids);

        return $this->formSuccess(
            route('admin.academic.subject.index'), 
            ['message' => 'Mata kuliah berhasil dihapus']
        );
    }
}