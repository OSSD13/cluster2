@extends('layouts.layout_user')

@section('content')

<h1 class="text-2xl font-semibold mt-4 text-left px-6">เพิ่มข้อมูล</h1>
<div class="p-4">
    <form id="formID" action="{{ route('home.add') }}" method="POST" enctype="multipart/form-data" onkeydown="return event.key !== 'Enter';">
        @csrf
        <!-- ชื่อชุมชน -->
        <label class="block mt-2 text-sm">ชื่อของชุมชน</label>
        <input type="text" id="community_name" name="community_name" class="w-full p-2 border rounded" placeholder="กรอกชื่อชุมชน">

        <!-- วันที่ & ตำแหน่ง -->
        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block mt-2 text-sm">วันที่ <span class="text-red-500">*</span></label>
                <div class="flex items-center border p-2 rounded">
                    <i class="fa-solid fa-calendar-days"></i>
                    <input type="date" id="add_date" name="add_date" class="w-full border-none focus:ring-0 ml-2">
                </div>
            </div>
            <div>
                <label class="block mt-2 text-sm">ตำแหน่ง <span class="text-red-500">*</span></label>
                <div class="flex items-center border p-2 rounded">
                    <i class="fa-solid fa-location-dot"></i>
                    <input id="latitude" name="latitude" type="text" hidden>
                    <input id="longitude" name="longitude" type="text" hidden>
                    <input id="location" name="location" type="text" class="w-full border-none focus:ring-0 ml-2" placeholder="เลือกตำแหน่งจากแผนที่">
                    <button type="button" onclick="openGoogleMaps()" class="ml-2">➤</button>
                </div>
            </div>
        </div>

        <!-- ที่อยู่ -->
        <label class="block mt-4 text-sm">ที่อยู่ <span class="text-red-500">*</span></label>
        <!-- ช่องที่อยู่เพิ่มเติม -->
        <input id="sub_district" name="sub_district" type="text" placeholder="ตำบล" class="mt-2 w-full border p-2 rounded">
        <input id="district" name="district" type="text" placeholder="อำเภอ" class="mt-2 w-full border p-2 rounded">
        <input id="province" name="province" type="text" placeholder="จังหวัด" class="mt-2 w-full border p-2 rounded">
        <input id="postcode" name="postcode" type="text" placeholder="รหัสไปรษณีย์" class="mt-2 w-full border p-2 rounded">

        <!-- ปัญหาที่พบ -->
        <input type="hidden" id="tags-hidden" name="tags">
        <div class="relative mt-4">
            <label class="block text-sm">ปัญหาที่พบ <span class="text-red-500">*</span></label>
            <div class="tags-input-wrapper w-full border rounded p-2 bg-white">
                <ul id="tags" class="flex flex-wrap gap-2">
                    <input type="text" id="tag-input" spellcheck="false" placeholder="พิมพ์ปัญหา" class="flex-1 outline-none text-sm p-1">
                </ul>
            </div>
            <ul id="autocomplete-list" class="absolute z-10 bg-white border rounded mt-1 w-full max-h-40 overflow-y-auto shadow hidden text-sm">
                <!-- Suggestions will appear here -->
            </ul>
        </div>

        <!-- รายละเอียดเพิ่มเติม -->
        <label class="block mt-4 text-sm">รายละเอียดเพิ่มเติม</label>
        <textarea id="detail" name="detail" class="w-full p-2 border rounded"></textarea>

        <!-- ปุ่ม ยืนยัน -->
        <div class="flex justify-center mt-6">
            <button id="submitBtn" class="bg-green-500 text-white px-6 py-2 rounded-full text-lg shadow-md hover:bg-green-600">
                ยืนยันข้อมูล
            </button>
        </div>
    </form>
</div>

<script>
    $.Thailand({
        $district: $("#sub_district"), // input ของตำบล
        $amphoe: $("#district"), // input ของอำเภอ
        $province: $("#province"), // input ของจังหวัด
        $zipcode: $("#postcode") // input ของรหัสไปรษณีย์
    });
</script>
</div>
@endsection

<style>
    #autocomplete-list li {
        padding: 8px 12px;
        cursor: pointer;
        transition: background 0.2s;
    }

    #autocomplete-list li:hover {
        background-color: #f3f4f6;
        /* Tailwind gray-100 */
    }

    .tags-input-wrapper {
        background: #fff;
        border: 1px solid #d1d5db;
        border-radius: 0.25rem;
        padding: 10px;
    }

    #tags {
        display: flex;
        flex-wrap: wrap;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    #tags li {
        display: flex;
        align-items: center;
        margin: 4px;
        padding: 5px 8px;
        background: #e5e7eb;
        border-radius: 5px;
        font-size: 14px;
    }

    #tags li.highlight {
        background: #2563eb;
        color: #fff;
    }

    #tags li .remove-tag {
        margin-left: 8px;
        font-size: 14px;
        cursor: pointer;
        color: #888;
    }

    #tags li .remove-tag:hover {
        color: #f00;
    }

    #tags input {
        flex: 1;
        padding: 5px;
        border: none;
        outline: none;
        font-size: 14px;
    }
</style>

<script>
    window.onload = function() {
        if (localStorage.getItem('form_data') || localStorage.getItem('latitude')) {
            const data = JSON.parse(localStorage.getItem('form_data'));
            document.getElementById('location').value = `latitude: ${localStorage.getItem('latitude')}, longitude: ${localStorage.getItem('longitude')}` || '';
            document.getElementById('latitude').value = localStorage.getItem('latitude')
            document.getElementById('longitude').value = localStorage.getItem('longitude')
        }
    }

    function saveFormToStorage() {
        const data = {
            title: document.getElementById('title').value,
            description: document.getElementById('description').value
        };

        localStorage.setItem('form_data', JSON.stringify(data));
    }

    function openGoogleMaps() {
        let address = document.getElementById("location").value;
        let url = "{{ route('addmap') }}";
        window.open(url, "_self");
    }

    //แท๊ก
    // ประกาศตัวแปรแบบ global
    let tagsList = [];
    let allowedTags = [];
    const tagSuggestions = [];
    const maxTags = 10000;

    // ฟังก์ชันสำหรับจัดการกับแท็ก
    function createTag(tagValue) {
        const tags = document.getElementById('tags');
        const tagInput = document.getElementById('tag-input');

        if (!tagValue) return;

        // ตัดช่องว่าง
        tagValue = tagValue.trim();
        if (tagValue === '') return;

        // ตรวจสอบว่าแท็กซ้ำหรือไม่
        const formattedTag = "#" + tagValue;
        if (tagsList.includes(formattedTag)) return;

        // สร้าง element ใหม่สำหรับแท็ก
        const li = document.createElement('li');
        const span = document.createElement('span');
        span.className = 'remove-tag';
        span.innerHTML = '×';

        li.textContent = formattedTag + ' ';
        li.appendChild(span);

        // เพิ่ม event listener สำหรับลบแท็ก
        span.addEventListener('click', function() {
            removeTag(li, formattedTag);
        });

        // เพิ่มแท็กเข้าไปใน DOM และ array
        tags.insertBefore(li, tagInput);
        tagsList.push(formattedTag);

        // ล้างค่าในช่อง input
        tagInput.value = '';

        return true; // แสดงว่าเพิ่มแท็กสำเร็จ
    }

    function removeTag(element, tag) {
        // ลบแท็กออกจาก array
        const index = tagsList.indexOf(tag);
        if (index > -1) {
            tagsList.splice(index, 1);
        }
        // ลบ element ออกจาก DOM
        element.remove();
    }

    // ฟังก์ชันเพิ่มแท็กใหม่ (ทั้งแท็กที่มีอยู่หรือสร้างใหม่)
    function handleTagInput(tagValue) {
        if (!tagValue) return;

        // ตรวจสอบว่าแท็กนี้มีอยู่แล้วในระบบหรือไม่
        if (allowedTags.includes(tagValue)) {
            // ถ้ามีอยู่แล้ว เพิ่มแท็กได้เลย
            createTag(tagValue);
        } else {
            // ถ้ายังไม่มี ส่งข้อมูลไปบันทึกแท็กใหม่ที่ backend ก่อน
            fetch("{{ route('tags.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        tag_name: tagValue
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // เพิ่มแท็กเข้า list ที่อนุญาต
                        allowedTags.push(tagValue);

                        // เพิ่มแท็กใน datalist
                        const datalist = document.getElementById("tagSuggestions");
                        const option = document.createElement("option");
                        option.value = tagValue;
                        datalist.appendChild(option);

                        // สร้างแท็กและแสดงในรายการ
                        createTag(tagValue);
                    } else {
                        if (data.message === 'แท็กนี้มีอยู่แล้ว') {
                            // กรณีนี้ไม่ควรเกิดขึ้นแล้ว แต่เผื่อไว้
                            createTag(tagValue);
                        } else {
                            alert("ไม่สามารถเพิ่มแท็กได้: " + data.message);
                        }
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("เกิดข้อผิดพลาดในการเพิ่มแท็ก");
                });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // ประกาศตัวแปรหลัก

        const form = document.getElementById("formID");
        const hiddenInput = document.getElementById("tags-hidden");

        if (form && hiddenInput) {
        form.addEventListener('submit', function () {
            hiddenInput.value = tagsList.join(',');
            });
        }

        const tagInput = document.getElementById('tag-input');
        const autoList = document.getElementById('autocomplete-list');
        const tagsContainer = document.getElementById('tags');

        let tagsList = []; // เก็บแท็กที่ถูกเลือกไปแล้ว
        let allowedTags = []; // แท็กที่มีในระบบ
        let tagSuggestions = []; // สำหรับแสดงใน autocomplete

        // โหลดแท็กจาก backend
        fetch("{{ route('tags.fetch') }}")
            .then(response => response.json())
            .then(data => {
                allowedTags = [...data];
                tagSuggestions = [...data];
            })
            .catch(err => {
                console.error("Failed to load tags:", err);
            });

        // ฟังก์ชันสร้างแท็ก
        function createTag(tagValue) {
            if (!tagValue) return false;

            // ตัดช่องว่างและตรวจสอบว่าว่างหรือไม่
            tagValue = tagValue.trim();
            if (tagValue === '') return false;

            // ตรวจสอบแท็กซ้ำ
            if (tagsList.includes(tagValue)) return false;

            // สร้าง element สำหรับแท็ก
            const li = document.createElement('li');
            const span = document.createElement('span');
            span.className = 'remove-tag';
            span.textContent = '×';

            li.textContent = "#" + tagValue + ' ';
            li.appendChild(span);

            // เพิ่ม event listener สำหรับลบแท็ก
            span.addEventListener('click', function() {
                removeTag(li, tagValue);
            });

            // เพิ่มแท็กเข้า DOM และ array
            tagsContainer.insertBefore(li, tagInput);
            tagsList.push(tagValue);

            // ล้างค่าในช่อง input
            tagInput.value = '';

            return true;
        }

        // ฟังก์ชันลบแท็ก
        function removeTag(element, tag) {
            const index = tagsList.indexOf(tag);
            if (index > -1) {
                tagsList.splice(index, 1);
            }
            element.remove();
        }

        // ฟังก์ชันจัดการการเพิ่มแท็ก
        function handleTagInput(tagValue) {
            if (!tagValue) return;
            tagValue = tagValue.trim();
            if (tagValue === '') return;

            if (allowedTags.includes(tagValue)) {
                createTag(tagValue);
            } else {
                createTag(tagValue)
            }
            /*}else {
                // ส่งข้อมูลไปบันทึกแท็กใหม่
                fetch("{{ route('tags.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ tag_name: tagValue })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        allowedTags.push(tagValue);
                        tagSuggestions.push(tagValue);
                        createTag(tagValue);
                    } else if (data.message === 'แท็กนี้มีอยู่แล้ว') {
                        createTag(tagValue);
                    } else {
                        alert("ไม่สามารถเพิ่มแท็กได้: " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("เกิดข้อผิดพลาดในการเพิ่มแท็ก");
                });
            }*/
        }

        // จัดการ Autocomplete
        tagInput.addEventListener('input', function() {
            const value = this.value.toLowerCase();
            autoList.innerHTML = '';

            if (!value) {
                autoList.classList.add('hidden');
                return;
            }

            const filtered = tagSuggestions.filter(tag =>
                tag.toLowerCase().includes(value)
            );

            if (filtered.length === 0) {
                autoList.classList.add('hidden');
                return;
            }

            filtered.forEach(tag => {
                const item = document.createElement('li');
                item.textContent = tag;

                // แก้ไขจุดนี้: ใช้ function แบบ declaration เพื่อจัดการกับ 'this'
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // สำคัญ: ใช้ค่า tag ที่ถูกเลือกจาก autocomplete โดยตรง
                    // ไม่ใช้ค่าจาก tagInput.value
                    createTag(tag);

                    // เคลียร์ input และซ่อน autocomplete list
                    tagInput.value = '';
                    autoList.classList.add('hidden');

                    // ให้ focus กลับไปที่ input เพื่อสะดวกในการเพิ่มแท็กต่อไป
                    tagInput.focus();
                });

                autoList.appendChild(item);
            });

            autoList.classList.remove('hidden');
        });

        // Event listeners for keyboard input
        tagInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                const tagValue = this.value.trim();
                if (tagValue) {
                    e.preventDefault();
                    handleTagInput(tagValue);
                    autoList.classList.add('hidden');
                }
            } else if (e.key === 'Escape') {
                // ซ่อน autocomplete เมื่อกด Escape
                autoList.classList.add('hidden');
            }
        });

        // ซ่อน autocomplete เมื่อคลิกที่อื่น
        document.addEventListener('click', function(e) {
            if (e.target !== tagInput && !autoList.contains(e.target)) {
                autoList.classList.add('hidden');
            }
        });

        // สำหรับอุปกรณ์มือถือ
        tagInput.addEventListener('blur', function() {
            // หน่วงเวลาเล็กน้อยเพื่อให้การคลิกบน autocomplete item ทำงานก่อน
            setTimeout(() => {
                if (!autoList.contains(document.activeElement)) {
                    autoList.classList.add('hidden');
                }
            }, 100);
        });
    });
    //จบ

    function initAutocomplete() {
        let input = document.getElementById("location");
        if (window.google && window.google.maps && window.google.maps.places) {
            let autocomplete = new google.maps.places.Autocomplete(input, {
                types: ['geocode'],
                componentRestrictions: {
                    country: "TH"
                }
            });
        }
    }

    function toggleMenu() {
        let menu = document.getElementById("menu");
        if (menu) {
            menu.classList.toggle("hidden");
        }
    }


    document.getElementById("formID").addEventListener('submit', function() {
        const hiddenInput = document.getElementById("tags-hidden");
        hiddenInput.value = tagsList.join(',');
    });

</script>