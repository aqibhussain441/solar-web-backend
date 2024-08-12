import "./bootstrap";
import toastr from "toastr";
import "toastr/build/toastr.min.css";
import 'quill/dist/quill.snow.css';
import Quill from 'quill';

window.Quill = Quill;

document.addEventListener("livewire:init", () => {
    Livewire.on("toast", (event) => {
        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: false,
            progressBar: true,
            positionClass: "toast-top-right",
            preventDuplicates: false,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            timeOut: "5000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
        };

        switch (event.type) {
            case "success":
                toastr.success(event.message);
                break;
            case "error":
                toastr.error(event.message);
                break;
            case "info":
                toastr.info(event.message);
                break;
            case "warning":
                toastr.warning(event.message);
                break;
        }
    });
});
