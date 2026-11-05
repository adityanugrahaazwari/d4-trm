<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAcademicCalendarRequest;
use App\Http\Requests\Admin\StoreAnnouncementRequest;
use App\Http\Requests\Admin\StoreCourseRequest;
use App\Http\Requests\Admin\StoreCplRequest;
use App\Http\Requests\Admin\StoreCurriculumRequest;
use App\Http\Requests\Admin\StoreEventRequest;
use App\Http\Requests\Admin\StoreFacilityRequest;
use App\Http\Requests\Admin\StoreGalleryAlbumRequest;
use App\Http\Requests\Admin\StoreGraduateProfileRequest;
use App\Http\Requests\Admin\StoreNewsRequest;
use App\Http\Requests\Admin\StoreStaffRequest;
use App\Http\Requests\Admin\UpdateAcademicCalendarRequest;
use App\Http\Requests\Admin\UpdateAnnouncementRequest;
use App\Http\Requests\Admin\UpdateCourseRequest;
use App\Http\Requests\Admin\UpdateCplRequest;
use App\Http\Requests\Admin\UpdateCurriculumRequest;
use App\Http\Requests\Admin\UpdateEventRequest;
use App\Http\Requests\Admin\UpdateFacilityRequest;
use App\Http\Requests\Admin\UpdateGalleryAlbumRequest;
use App\Http\Requests\Admin\UpdateGraduateProfileRequest;
use App\Http\Requests\Admin\UpdateNewsRequest;
use App\Http\Requests\Admin\UpdateProfileSectionRequest;
use App\Http\Requests\Admin\UpdateSettingRequest;
use App\Http\Requests\Admin\UpdateStaffRequest;
use App\Models\AcademicCalendar;
use App\Models\Announcement;
use App\Models\Course;
use App\Models\Cpl;
use App\Models\Curriculum;
use App\Models\Event;
use App\Models\Facility;
use App\Models\GalleryAlbum;
use App\Models\GraduateProfile;
use App\Models\News;
use App\Models\Setting;
use App\Models\Staff;
use App\Models\StudyProgramProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    /**
     * Dosen & Tendik
     */
    public function storeStaff(StoreStaffRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $section = $validated['type'] === 'tendik' ? 'tendik' : 'dosen';

        $photo = $validated['photo'] ?? null;
        if ($request->hasFile('photo_file') && $request->file('photo_file')->isValid()) {
            $path = $request->file('photo_file')->store('staff', 'public');
            $photo = '/storage/'.$path;
        }

        $nipNidn = $validated['nip_nidn'] ?? null;
        if (! $nipNidn) {
            $nip = trim((string) ($validated['nip'] ?? ''));
            $nidn = trim((string) ($validated['nidn'] ?? ''));
            if ($nip !== '' && $nidn !== '') {
                $nipNidn = "NIP. {$nip} / NIDN. {$nidn}";
            } elseif ($nip !== '') {
                $nipNidn = $nip;
            } elseif ($nidn !== '') {
                $nipNidn = $nidn;
            }
        }

        $education = $validated['education'] ?? $validated['academic_degree'] ?? null;

        $isActive = true;
        if ($request->has('is_active')) {
            $val = $request->input('is_active');
            $isActive = in_array($val, [true, 1, '1', 'published', 'aktif', 'active'], true);
        } elseif ($request->has('status')) {
            $isActive = in_array($request->input('status'), ['published', 'active', 'aktif', '1'], true);
        }

        Staff::create([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'nip_nidn' => $nipNidn,
            'position' => $validated['position'] ?? null,
            'expertise' => $validated['expertise'] ?? null,
            'education' => $education,
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'photo' => $photo,
            'order' => (int) ($validated['order'] ?? 0),
            'is_active' => $isActive,
        ]);

        return redirect()->route('admin.crud.sample', ['section' => $section])
            ->with('success', 'Data staf pengajar/kependidikan berhasil ditambahkan.');
    }

    public function updateStaff(UpdateStaffRequest $request, Staff $staff): RedirectResponse
    {
        $validated = $request->validated();
        $section = $staff->type === 'tendik' ? 'tendik' : 'dosen';

        $photo = $staff->photo;
        if ($request->hasFile('photo_file') && $request->file('photo_file')->isValid()) {
            if ($staff->photo && str_starts_with($staff->photo, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $staff->photo);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('photo_file')->store('staff', 'public');
            $photo = '/storage/'.$path;
        } elseif (isset($validated['photo']) && $validated['photo'] !== '') {
            $photo = $validated['photo'];
        }

        $nipNidn = $validated['nip_nidn'] ?? null;
        if (! $nipNidn) {
            $nip = trim((string) ($validated['nip'] ?? ''));
            $nidn = trim((string) ($validated['nidn'] ?? ''));
            if ($nip !== '' && $nidn !== '') {
                $nipNidn = "NIP. {$nip} / NIDN. {$nidn}";
            } elseif ($nip !== '') {
                $nipNidn = $nip;
            } elseif ($nidn !== '') {
                $nipNidn = $nidn;
            } else {
                $nipNidn = $staff->nip_nidn;
            }
        }

        $education = $validated['education'] ?? $validated['academic_degree'] ?? $staff->education;

        $isActive = $staff->is_active;
        if ($request->has('is_active')) {
            $val = $request->input('is_active');
            $isActive = in_array($val, [true, 1, '1', 'published', 'aktif', 'active'], true);
        } elseif ($request->has('status')) {
            $isActive = in_array($request->input('status'), ['published', 'active', 'aktif', '1'], true);
        }

        $staff->update([
            'name' => $validated['name'],
            'type' => $validated['type'] ?? $staff->type,
            'nip_nidn' => $nipNidn,
            'position' => $validated['position'] ?? $staff->position,
            'expertise' => $validated['expertise'] ?? $staff->expertise,
            'education' => $education,
            'email' => $validated['email'] ?? $staff->email,
            'phone' => $validated['phone'] ?? $staff->phone,
            'photo' => $photo,
            'order' => isset($validated['order']) ? (int) $validated['order'] : $staff->order,
            'is_active' => $isActive,
        ]);

        return redirect()->route('admin.crud.sample', ['section' => $section])
            ->with('success', "Data '{$staff->name}' berhasil diperbarui.");
    }

    public function destroyStaff(Staff $staff): RedirectResponse
    {
        $section = $staff->type === 'tendik' ? 'tendik' : 'dosen';
        $name = $staff->name;

        if ($staff->photo && str_starts_with($staff->photo, '/storage/')) {
            $oldPath = str_replace('/storage/', '', $staff->photo);
            Storage::disk('public')->delete($oldPath);
        }

        $staff->delete();

        return redirect()->route('admin.crud.sample', ['section' => $section])
            ->with('success', "Data staf '{$name}' berhasil dihapus.");
    }

    /**
     * Berita & Informasi
     */
    public function storeNews(StoreNewsRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $slug = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);

        News::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'category_id' => $validated['category_id'] ?? null,
            'author_id' => auth()->id(),
            'excerpt' => $validated['excerpt'] ?? Str::limit(strip_tags($validated['content']), 150),
            'content' => $validated['content'],
            'status' => $validated['status'] ?? 'published',
            'published_at' => $validated['published_at'] ?? now(),
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'berita'])
            ->with('success', 'Berita berhasil diterbitkan.');
    }

    public function updateNews(UpdateNewsRequest $request, News $news): RedirectResponse
    {
        $validated = $request->validated();
        $slug = ! empty($validated['slug']) ? Str::slug($validated['slug']) : $news->slug;

        $news->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'category_id' => $validated['category_id'] ?? $news->category_id,
            'excerpt' => $validated['excerpt'] ?? Str::limit(strip_tags($validated['content']), 150),
            'content' => $validated['content'],
            'status' => $validated['status'] ?? $news->status,
            'published_at' => $validated['published_at'] ?? $news->published_at,
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'berita'])
            ->with('success', "Berita '{$news->title}' berhasil diperbarui.");
    }

    public function destroyNews(News $news): RedirectResponse
    {
        $title = $news->title;
        $news->delete();

        return redirect()->route('admin.crud.sample', ['section' => 'berita'])
            ->with('success', "Berita '{$title}' berhasil dihapus.");
    }

    /**
     * Pengumuman
     */
    public function storeAnnouncement(StoreAnnouncementRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $slug = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);

        Announcement::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'content' => $validated['content'],
            'status' => $validated['status'] ?? 'Akademik',
            'published_at' => $validated['published_at'] ?? now(),
            'is_active' => (bool) ($validated['is_active'] ?? true),
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'pengumuman'])
            ->with('success', 'Pengumuman resmi berhasil ditambahkan.');
    }

    public function updateAnnouncement(UpdateAnnouncementRequest $request, Announcement $announcement): RedirectResponse
    {
        $validated = $request->validated();
        $slug = ! empty($validated['slug']) ? Str::slug($validated['slug']) : $announcement->slug;

        $announcement->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'content' => $validated['content'],
            'status' => $validated['status'] ?? $announcement->status,
            'published_at' => $validated['published_at'] ?? $announcement->published_at,
            'is_active' => isset($validated['is_active']) ? (bool) $validated['is_active'] : $announcement->is_active,
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'pengumuman'])
            ->with('success', "Pengumuman '{$announcement->title}' berhasil diperbarui.");
    }

    public function destroyAnnouncement(Announcement $announcement): RedirectResponse
    {
        $title = $announcement->title;
        $announcement->delete();

        return redirect()->route('admin.crud.sample', ['section' => 'pengumuman'])
            ->with('success', "Pengumuman '{$title}' berhasil dihapus.");
    }

    /**
     * Agenda Kegiatan
     */
    public function storeEvent(StoreEventRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $slug = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);

        Event::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
            'location' => $validated['location'],
            'event_date' => $validated['event_date'],
            'start_time' => $validated['start_time'] ?? '09:00',
            'end_time' => $validated['end_time'] ?? '15:00',
            'speaker' => $validated['speaker'] ?? null,
            'registration_url' => $validated['registration_url'] ?? null,
            'status' => $validated['status'] ?? 'Pendaftaran Dibuka',
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'agenda'])
            ->with('success', 'Agenda kegiatan berhasil dijadwalkan.');
    }

    public function updateEvent(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $validated = $request->validated();
        $slug = ! empty($validated['slug']) ? Str::slug($validated['slug']) : $event->slug;

        $event->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'description' => $validated['description'] ?? $event->description,
            'location' => $validated['location'],
            'event_date' => $validated['event_date'],
            'start_time' => $validated['start_time'] ?? $event->start_time,
            'end_time' => $validated['end_time'] ?? $event->end_time,
            'speaker' => $validated['speaker'] ?? $event->speaker,
            'registration_url' => $validated['registration_url'] ?? $event->registration_url,
            'status' => $validated['status'] ?? $event->status,
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'agenda'])
            ->with('success', "Agenda '{$event->title}' berhasil diperbarui.");
    }

    public function destroyEvent(Event $event): RedirectResponse
    {
        $title = $event->title;
        $event->delete();

        return redirect()->route('admin.crud.sample', ['section' => 'agenda'])
            ->with('success', "Agenda '{$title}' berhasil dihapus.");
    }

    /**
     * Kurikulum & Mata Kuliah
     */
    public function storeCurriculum(StoreCurriculumRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $code = ! empty($validated['code']) ? $validated['code'] : 'KUR-'.Str::slug($validated['year']);

        Curriculum::create([
            'name' => $validated['name'],
            'code' => $code,
            'year' => $validated['year'],
            'description' => $validated['description'] ?? null,
            'total_sks' => $validated['total_credits'] ?? $validated['total_sks'] ?? 144,
            'is_active' => (bool) ($validated['is_active'] ?? true),
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'kurikulum'])
            ->with('success', 'Kurikulum baru berhasil ditambahkan.');
    }

    public function updateCurriculum(UpdateCurriculumRequest $request, Curriculum $curriculum): RedirectResponse
    {
        $validated = $request->validated();

        $curriculum->update([
            'name' => $validated['name'],
            'year' => $validated['year'],
            'description' => $validated['description'] ?? $curriculum->description,
            'total_sks' => $validated['total_credits'] ?? $validated['total_sks'] ?? $curriculum->total_sks,
            'is_active' => isset($validated['is_active']) ? (bool) $validated['is_active'] : $curriculum->is_active,
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'kurikulum'])
            ->with('success', "Kurikulum '{$curriculum->name}' berhasil diperbarui.");
    }

    public function destroyCurriculum(Curriculum $curriculum): RedirectResponse
    {
        $name = $curriculum->name;
        $curriculum->delete();

        return redirect()->route('admin.crud.sample', ['section' => 'kurikulum'])
            ->with('success', "Kurikulum '{$name}' berhasil dihapus.");
    }

    public function storeCourse(StoreCourseRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $theory = $validated['theory_sks'] ?? $validated['theory_credits'] ?? 2;
        $practical = $validated['practical_sks'] ?? $validated['practice_credits'] ?? 2;

        Course::create([
            'curriculum_id' => $validated['curriculum_id'],
            'code' => strtoupper($validated['code']),
            'name' => $validated['name'],
            'semester' => $validated['semester'],
            'sks' => $theory + $practical,
            'theory_sks' => $theory,
            'practical_sks' => $practical,
            'type' => ($validated['is_mandatory'] ?? true) ? 'Wajib' : 'Pilihan',
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'mata-kuliah'])
            ->with('success', 'Mata kuliah berhasil ditambahkan ke kurikulum.');
    }

    public function updateCourse(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        $validated = $request->validated();
        $theory = $validated['theory_sks'] ?? $validated['theory_credits'] ?? $course->theory_sks;
        $practical = $validated['practical_sks'] ?? $validated['practice_credits'] ?? $course->practical_sks;

        $course->update([
            'curriculum_id' => $validated['curriculum_id'],
            'code' => strtoupper($validated['code']),
            'name' => $validated['name'],
            'semester' => $validated['semester'],
            'sks' => $theory + $practical,
            'theory_sks' => $theory,
            'practical_sks' => $practical,
            'type' => isset($validated['is_mandatory']) ? ($validated['is_mandatory'] ? 'Wajib' : 'Pilihan') : $course->type,
            'description' => $validated['description'] ?? $course->description,
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'mata-kuliah'])
            ->with('success', "Mata kuliah '{$course->name}' berhasil diperbarui.");
    }

    public function destroyCourse(Course $course): RedirectResponse
    {
        $name = $course->name;
        $course->delete();

        return redirect()->route('admin.crud.sample', ['section' => 'mata-kuliah'])
            ->with('success', "Mata kuliah '{$name}' berhasil dihapus.");
    }

    /**
     * Kalender Akademik
     */
    public function storeCalendar(StoreAcademicCalendarRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        AcademicCalendar::create([
            'academic_year' => $validated['academic_year'],
            'semester' => $validated['semester'],
            'title' => $validated['title'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?? null,
            'description' => $validated['description'] ?? null,
            'is_active' => (bool) ($validated['is_active'] ?? true),
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'kalender'])
            ->with('success', 'Agenda kalender akademik berhasil ditambahkan.');
    }

    public function updateCalendar(UpdateAcademicCalendarRequest $request, AcademicCalendar $calendar): RedirectResponse
    {
        $validated = $request->validated();

        $calendar->update([
            'academic_year' => $validated['academic_year'],
            'semester' => $validated['semester'],
            'title' => $validated['title'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?? $calendar->end_date,
            'description' => $validated['description'] ?? $calendar->description,
            'is_active' => isset($validated['is_active']) ? (bool) $validated['is_active'] : $calendar->is_active,
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'kalender'])
            ->with('success', "Agenda '{$calendar->title}' berhasil diperbarui.");
    }

    public function destroyCalendar(AcademicCalendar $calendar): RedirectResponse
    {
        $title = $calendar->title;
        $calendar->delete();

        return redirect()->route('admin.crud.sample', ['section' => 'kalender'])
            ->with('success', "Agenda '{$title}' berhasil dihapus.");
    }

    /**
     * CPL
     */
    public function storeCpl(StoreCplRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Cpl::create([
            'code' => strtoupper($validated['code']),
            'category' => $validated['category'],
            'description' => $validated['description'],
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'cpl'])
            ->with('success', 'Butir Capaian Pembelajaran Lulusan (CPL) berhasil ditambahkan.');
    }

    public function updateCpl(UpdateCplRequest $request, Cpl $cpl): RedirectResponse
    {
        $validated = $request->validated();

        $cpl->update([
            'code' => strtoupper($validated['code']),
            'category' => $validated['category'],
            'description' => $validated['description'],
            'order' => $validated['order'] ?? $cpl->order,
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'cpl'])
            ->with('success', "CPL '{$cpl->code}' berhasil diperbarui.");
    }

    public function destroyCpl(Cpl $cpl): RedirectResponse
    {
        $code = $cpl->code;
        $cpl->delete();

        return redirect()->route('admin.crud.sample', ['section' => 'cpl'])
            ->with('success', "CPL '{$code}' berhasil dihapus.");
    }

    /**
     * Profil Lulusan
     */
    public function storeGraduateProfile(StoreGraduateProfileRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        GraduateProfile::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'career_prospects' => $validated['career_prospects'] ?? null,
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'profil-lulusan'])
            ->with('success', 'Profil lulusan berhasil ditambahkan.');
    }

    public function updateGraduateProfile(UpdateGraduateProfileRequest $request, GraduateProfile $graduateProfile): RedirectResponse
    {
        $validated = $request->validated();

        $graduateProfile->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'career_prospects' => $validated['career_prospects'] ?? $graduateProfile->career_prospects,
            'order' => $validated['order'] ?? $graduateProfile->order,
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'profil-lulusan'])
            ->with('success', "Profil lulusan '{$graduateProfile->title}' berhasil diperbarui.");
    }

    public function destroyGraduateProfile(GraduateProfile $graduateProfile): RedirectResponse
    {
        $title = $graduateProfile->title;
        $graduateProfile->delete();

        return redirect()->route('admin.crud.sample', ['section' => 'profil-lulusan'])
            ->with('success', "Profil lulusan '{$title}' berhasil dihapus.");
    }

    /**
     * Fasilitas
     */
    public function storeFacility(StoreFacilityRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $slug = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['name']);

        $image = $validated['image'] ?? null;
        if ($request->hasFile('image_file') && $request->file('image_file')->isValid()) {
            $image = $request->file('image_file')->store('facilities', 'public');
        }

        $isActive = true;
        if ($request->has('is_active')) {
            $val = $request->input('is_active');
            $isActive = in_array($val, [true, 1, '1', 'aktif', 'active', 'published'], true);
        }

        Facility::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'category' => $validated['category'] ?? 'Laboratorium Komputer',
            'description' => $validated['description'] ?? null,
            'specifications' => $validated['specifications'] ?? null,
            'software' => $validated['software'] ?? null,
            'capacity' => isset($validated['capacity']) ? (int) $validated['capacity'] : 30,
            'location' => $validated['location'] ?? 'Gedung TI POLITALA',
            'image' => $image,
            'order' => isset($validated['order']) ? (int) $validated['order'] : 0,
            'is_active' => $isActive,
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'fasilitas'])
            ->with('success', "Fasilitas / laboratorium '{$validated['name']}' berhasil ditambahkan.");
    }

    public function updateFacility(UpdateFacilityRequest $request, Facility $facility): RedirectResponse
    {
        $validated = $request->validated();
        $slug = ! empty($validated['slug']) ? Str::slug($validated['slug']) : $facility->slug;

        $image = $facility->image;
        if ($request->hasFile('image_file') && $request->file('image_file')->isValid()) {
            if ($facility->image && ! str_starts_with($facility->image, 'http') && ! str_starts_with($facility->image, '/assets') && Storage::disk('public')->exists($facility->image)) {
                Storage::disk('public')->delete($facility->image);
            }
            $image = $request->file('image_file')->store('facilities', 'public');
        } elseif ($request->filled('image')) {
            $image = $validated['image'];
        }

        $isActive = $facility->is_active;
        if ($request->has('is_active')) {
            $val = $request->input('is_active');
            $isActive = in_array($val, [true, 1, '1', 'aktif', 'active', 'published'], true);
        }

        $facility->update([
            'name' => $validated['name'],
            'slug' => $slug,
            'category' => $validated['category'] ?? $facility->category,
            'description' => $validated['description'] ?? $facility->description,
            'specifications' => $validated['specifications'] ?? $facility->specifications,
            'software' => $validated['software'] ?? $facility->software,
            'capacity' => isset($validated['capacity']) ? (int) $validated['capacity'] : $facility->capacity,
            'location' => $validated['location'] ?? $facility->location,
            'image' => $image,
            'order' => isset($validated['order']) ? (int) $validated['order'] : $facility->order,
            'is_active' => $isActive,
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'fasilitas'])
            ->with('success', "Fasilitas '{$facility->name}' berhasil diperbarui.");
    }

    public function destroyFacility(Facility $facility): RedirectResponse
    {
        $name = $facility->name;
        if ($facility->image && ! str_starts_with($facility->image, 'http') && ! str_starts_with($facility->image, '/assets') && Storage::disk('public')->exists($facility->image)) {
            Storage::disk('public')->delete($facility->image);
        }
        $facility->delete();

        return redirect()->route('admin.crud.sample', ['section' => 'fasilitas'])
            ->with('success', "Fasilitas '{$name}' berhasil dihapus.");
    }

    /**
     * Album Galeri
     */
    public function storeGalleryAlbum(StoreGalleryAlbumRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $slug = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);

        GalleryAlbum::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
            'is_active' => (bool) ($validated['is_active'] ?? true),
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'album-galeri'])
            ->with('success', 'Album galeri dokumentasi berhasil dibuat.');
    }

    public function updateGalleryAlbum(UpdateGalleryAlbumRequest $request, GalleryAlbum $galleryAlbum): RedirectResponse
    {
        $validated = $request->validated();
        $slug = ! empty($validated['slug']) ? Str::slug($validated['slug']) : $galleryAlbum->slug;

        $galleryAlbum->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'description' => $validated['description'] ?? $galleryAlbum->description,
            'is_active' => isset($validated['is_active']) ? (bool) $validated['is_active'] : $galleryAlbum->is_active,
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'album-galeri'])
            ->with('success', "Album '{$galleryAlbum->title}' berhasil diperbarui.");
    }

    public function destroyGalleryAlbum(GalleryAlbum $galleryAlbum): RedirectResponse
    {
        $title = $galleryAlbum->title;
        $galleryAlbum->delete();

        return redirect()->route('admin.crud.sample', ['section' => 'album-galeri'])
            ->with('success', "Album '{$title}' berhasil dihapus.");
    }

    /**
     * Profil Program Studi (Sejarah, Visi-Misi, Sambutan, Struktur)
     */
    public function updateProfileSection(UpdateProfileSectionRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $dbSection = str_replace('-', '_', $validated['section']);

        $existing = StudyProgramProfile::where('section', $dbSection)->first();
        $currentMeta = is_array($existing?->meta) ? $existing->meta : [];
        $inputMeta = $request->input('meta', []);

        if ($request->hasFile('kaprodi_photo_file') && $request->file('kaprodi_photo_file')->isValid()) {
            $path = $request->file('kaprodi_photo_file')->store('profiles', 'public');
            $inputMeta['kaprodi_photo_url'] = '/storage/'.$path;
        }

        $mergedMeta = array_merge($currentMeta, $inputMeta);

        StudyProgramProfile::updateOrCreate(
            ['section' => $dbSection],
            [
                'title' => $validated['title'],
                'content' => $validated['content'],
                'meta' => $mergedMeta,
            ]
        );

        return redirect()->route('admin.crud.sample', ['section' => $validated['section']])
            ->with('success', "Uraian resmi {$validated['title']} berhasil diperbarui.");
    }

    /**
     * Pengaturan Identitas & Website
     */
    public function updateSettings(UpdateSettingRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $section = $request->input('section', 'identitas');

        foreach ($validated['settings'] as $key => $val) {
            Setting::set($key, $val);
        }

        return redirect()->route('admin.crud.sample', ['section' => $section])
            ->with('success', 'Pengaturan identitas dan sistem berhasil disimpan.');
    }
}
