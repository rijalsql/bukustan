// Di dalam method before()
if (session()->get('role') !== 'admin') {
    return redirect()->to('/login')->with('error', 'Anda tidak punya akses!');
}