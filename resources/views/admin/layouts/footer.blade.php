          <!-- content-wrapper ends -->
        
          <!-- FOOTER  -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © Memon Medical Institute Hospital </a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> made with <i class="mdi mdi-heart text-danger"></i></span>
            </div>
          </footer>
          <!-- FOOTER END  -->

        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('js/misc.js') }}"></script>
    <script>
  setTimeout(() => {
    document.querySelectorAll(".alert").forEach(el => el.remove());
  }, 4000);




let idleMinutes = 0;
const maxIdleMinutes = 15; // match SESSION_LIFETIME

function resetIdle() {
    idleMinutes = 0;
}
document.onmousemove = resetIdle;
document.onkeypress = resetIdle;
document.onclick = resetIdle;
document.onscroll = resetIdle;

setInterval(() => {
    idleMinutes++;
    if (idleMinutes >= maxIdleMinutes) {
        // optionally: show a warning first
        alert("Session expired due to inactivity. You will be logged out.");
        window.location.href = "{{ route('admin.logout') }}";
    }
}, 60000); // check every 1 minute
</script>


  </body>
</html>