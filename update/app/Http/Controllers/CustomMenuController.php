<?php

namespace App\Http\Controllers;

use App\Models\CustomMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomMenuController extends Controller
{
    /**
     * Display a listing of custom menus.
     */
    public function index()
    {
        $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();

        // Auto-seed default menus if the table is empty
        if (CustomMenu::count() === 0) {
            try {
                \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'DefaultMenuSeeder', '--force' => true]);
            } catch (\Exception $e) {
                logger()->error('Auto-seeding default menus failed: ' . $e->getMessage());
            }
        }

        $menus = CustomMenu::with('children')
            ->whereNull('parent_id')
            ->orderBy('urutan', 'asc')
            ->get();

        return view('admin.menu.index', compact('menus', 'settings'));
    }

    /**
     * Show the form for creating a new custom menu.
     */
    public function create()
    {
        $parentMenus = CustomMenu::whereNull('parent_id')->orderBy('urutan', 'asc')->get();
        return view('admin.menu.create', compact('parentMenus'));
    }

    /**
     * Store a newly created custom menu in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:custom_menus,id',
            'url' => 'nullable|string|max:255',
            'konten' => 'nullable|string',
            'urutan' => 'required|integer|min:0',
            'penempatan' => 'required|string|in:header,footer,both',
        ]);

        $data = $request->only(['nama', 'parent_id', 'url', 'konten', 'urutan', 'penempatan']);
        $data['is_editor'] = $request->has('is_editor');
        $data['is_table'] = $request->has('is_table');
        $data['is_chart'] = $request->has('is_chart');
        $data['is_form'] = $request->has('is_form');
        $data['aktif'] = $request->has('aktif');
        $data['slug'] = Str::slug($request->nama);

        // Ensure unique slug
        $count = CustomMenu::where('slug', 'like', $data['slug'] . '%')->count();
        if ($count > 0) {
            $data['slug'] = $data['slug'] . '-' . ($count + 1);
        }

        CustomMenu::create($data);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified custom menu.
     */
    public function edit($id)
    {
        $menu = CustomMenu::findOrFail($id);
        $parentMenus = CustomMenu::whereNull('parent_id')
            ->where('id', '!=', $id)
            ->orderBy('urutan', 'asc')
            ->get();

        return view('admin.menu.edit', compact('menu', 'parentMenus'));
    }

    /**
     * Update the specified custom menu in storage.
     */
    public function update(Request $request, $id)
    {
        $menu = CustomMenu::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:custom_menus,id',
            'url' => 'nullable|string|max:255',
            'konten' => 'nullable|string',
            'urutan' => 'required|integer|min:0',
            'penempatan' => 'required|string|in:header,footer,both',
        ]);

        $data = $request->only(['nama', 'parent_id', 'url', 'konten', 'urutan', 'penempatan']);
        $data['is_editor'] = $request->has('is_editor');
        $data['is_table'] = $request->has('is_table');
        $data['is_chart'] = $request->has('is_chart');
        $data['is_form'] = $request->has('is_form');
        $data['aktif'] = $request->has('aktif');
        
        if ($menu->nama !== $request->nama) {
            $data['slug'] = Str::slug($request->nama);
            // Ensure unique slug
            $count = CustomMenu::where('slug', 'like', $data['slug'] . '%')->where('id', '!=', $id)->count();
            if ($count > 0) {
                $data['slug'] = $data['slug'] . '-' . ($count + 1);
            }
        }

        $menu->update($data);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diperbarui!');
    }

    /**
     * Remove the specified custom menu from storage.
     */
    public function destroy($id)
    {
        $menu = CustomMenu::findOrFail($id);
        
        // Children will have parent_id set to null by DB cascade or trigger
        $menu->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus!');
    }
}
