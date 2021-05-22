<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactStoreRequest;
use App\Models\Contact;
use App\Repositories\ContactRepository;

class ContactController extends Controller
{
    private const PERPAGE = 15;
    /**
     * @var ContactRepository
     */
    private $contactRepository;


    /**
     * ContactController constructor.
     * @param ContactRepository $contactRepository
     */
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
        $this->authorizeResource(Contact::class, 'contact');
    }

    public function index()
    {
        $contacts = $this->contactRepository->getPaginateOrdreBy(self::PERPAGE, 'created_at');

        return view('admin.contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('client.contacts.create');
    }

    public function store(ContactStoreRequest $request)
    {
        $this->contactRepository->store($request->all());

        session()->flash('success', 'Thankyou, your message is taken into consederation.');

        return $request->ajax()
            ? response()->json(['route' => route('main')])
            : redirect()->route('main');
    }

    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $this->contactRepository->destroy($contact);

        session()->flash('success', 'Record removed');

        return request()->ajax()
            ? response()->json(['route' => route('contacts.index')])
            : redirect()->route('contacts.index');
    }

}
