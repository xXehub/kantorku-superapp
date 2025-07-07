 <div class="modal fade" id="settingsModal" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">
                     <i class="fas fa-cog text-secondary"></i> Pengaturan
                 </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <div class="row">
                     <div class="col-12 mb-3">
                         <label class="form-label">Tema Tampilan</label>
                         <select class="form-select" id="themeSelector">
                             <option value="light">Light</option>
                             <option value="dark">Dark</option>
                             <option value="auto">Auto</option>
                         </select>
                     </div>
                     <div class="col-12 mb-3">
                         <label class="form-label">Notifikasi</label>
                         <div class="form-check form-switch">
                             <input class="form-check-input" type="checkbox" id="notificationsToggle" checked>
                             <label class="form-check-label" for="notificationsToggle">
                                 Aktifkan notifikasi browser
                             </label>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                 <button type="button" class="btn btn-primary" onclick="saveSettings()">Simpan</button>
             </div>
         </div>
     </div>
 </div>
