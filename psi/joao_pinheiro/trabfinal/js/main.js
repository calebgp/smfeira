/**
 * JavaScript Principal do Sistema de Gestão
 * Sistema de Gestão de Produtos e Fornecedores
 * Moderno, leve e sem dependências de jQuery
 */

document.addEventListener("DOMContentLoaded", function () {
  // Inicializar tooltips
  const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
  );
  tooltipTriggerList.forEach(function (tooltipTriggerEl) {
    new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // Inicializar popovers
  const popoverTriggerList = document.querySelectorAll(
    '[data-bs-toggle="popover"]'
  );
  popoverTriggerList.forEach(function (popoverTriggerEl) {
    new bootstrap.Popover(popoverTriggerEl);
  });

  // Aplicar máscaras de input (Vanilla JS)
  initInputMasks();

  // Confirmação de exclusão
  const dangerForms = document.querySelectorAll("form");
  dangerForms.forEach(function (form) {
    form.addEventListener("submit", function (e) {
      const submitBtn = form.querySelector('button[type="submit"].btn-danger');
      if (submitBtn && !form.dataset.confirmed) {
        // Verificar se é um modal de confirmação
        const modal = form.closest(".modal");
        if (!modal) {
          e.preventDefault();
          if (confirm("Tem certeza que deseja executar esta ação?")) {
            form.dataset.confirmed = "true";
            form.submit();
          }
        }
      }
    });
  });

  // Auto-hide alerts after 5 seconds
  const alerts = document.querySelectorAll(".alert:not(.alert-permanent)");
  alerts.forEach(function (alert) {
    setTimeout(function () {
      if (alert.classList.contains("fade")) {
        new bootstrap.Alert(alert).close();
      } else {
        alert.style.transition = "opacity 0.5s ease";
        alert.style.opacity = "0";
        setTimeout(function () {
          alert.remove();
        }, 500);
      }
    }, 5000);
  });

  // Loader ao submeter formulários
  const submitButtons = document.querySelectorAll(
    'button[type="submit"]:not(.no-loading)'
  );
  submitButtons.forEach(function (btn) {
    btn.addEventListener("click", function (e) {
      if (btn.form && !btn.disabled) {
        const originalText = btn.innerHTML;
        btn.innerHTML =
          '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Processando...';
        btn.disabled = true;
        btn.classList.add("loading");

        // Reabilitar após 30 segundos (fallback)
        setTimeout(function () {
          if (btn.classList.contains("loading")) {
            btn.innerHTML = originalText;
            btn.disabled = false;
            btn.classList.remove("loading");
          }
        }, 30000);
      }
    });
  });

  // Atualizar badge de status baseado na quantidade
  const quantidadeInput = document.querySelector('input[name="quantidade"]');
  const statusSelect = document.querySelector('select[name="status"]');

  if (quantidadeInput && statusSelect) {
    quantidadeInput.addEventListener("input", function (e) {
      const qtd = parseInt(e.target.value) || 0;
      const statusOption = statusSelect.querySelector('option[value="ativo"]');
      const lowStockOption = statusSelect.querySelector(
        'option[value="estoque_baixo"]'
      );
      const inactiveOption = statusSelect.querySelector(
        'option[value="inativo"]'
      );

      if (qtd <= 10 && qtd > 0 && lowStockOption) {
        lowStockOption.selected = true;
      } else if (qtd === 0 && inactiveOption) {
        inactiveOption.selected = true;
      } else if (statusOption) {
        statusOption.selected = true;
      }
    });
  }

  // Busca em tempo real (debounce)
  const buscaInput = document.getElementById("busca");
  if (buscaInput) {
    let timeout = null;
    buscaInput.addEventListener("input", function (e) {
      clearTimeout(timeout);
      timeout = setTimeout(function () {
        const form = buscaInput.closest("form");
        if (form && form.id !== "logout-form") {
          form.submit();
        }
      }, 500);
    });
  }

  // Checkbox "Selecionar todos"
  const selectAllCheckbox = document.getElementById("select-all");
  if (selectAllCheckbox) {
    selectAllCheckbox.addEventListener("change", function (e) {
      const checkboxes = document.querySelectorAll(".item-checkbox");
      checkboxes.forEach(function (cb) {
        cb.checked = e.target.checked;
      });
    });
  }

  // Animação de fade-in para elementos
  const fadeElements = document.querySelectorAll(".fade-in");
  fadeElements.forEach(function (el) {
    el.style.opacity = "0";
    el.style.transform = "translateY(10px)";
    el.style.transition = "opacity 0.5s ease, transform 0.5s ease";
    setTimeout(function () {
      el.style.opacity = "1";
      el.style.transform = "translateY(0)";
    }, 100);
  });

  // Animate elements on scroll
  initScrollAnimations();

  // Initialize price formatting
  initPriceFormatting();

  // Initialize phone formatting
  initPhoneFormatting();
});

/**
 * Inicializar máscaras de input
 */
function initInputMasks() {
  const phoneInputs = document.querySelectorAll('input[name="telefone"]');
  phoneInputs.forEach(function (input) {
    input.addEventListener("input", function (e) {
      let value = e.target.value.replace(/\D/g, "");
      if (value.length > 0) {
        if (value.length <= 2) {
          value = "(" + value;
        } else if (value.length <= 6) {
          value = "(" + value.substring(0, 2) + ") " + value.substring(2);
        } else if (value.length <= 10) {
          value =
            "(" +
            value.substring(0, 2) +
            ") " +
            value.substring(2, 6) +
            "-" +
            value.substring(6);
        } else {
          value =
            "(" +
            value.substring(0, 2) +
            ") " +
            value.substring(2, 7) +
            "-" +
            value.substring(7, 11);
        }
      }
      e.target.value = value;
    });
  });
}

/**
 * Inicializar formatação de preço
 */
function initPriceFormatting() {
  const precoInputs = document.querySelectorAll('input[name="preco"]');
  precoInputs.forEach(function (input) {
    input.addEventListener("blur", function (e) {
      let value = e.target.value.replace(/\D/g, "");
      if (value) {
        value = (parseInt(value) / 100).toFixed(2);
        value = value.replace(".", ",");
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        e.target.value = "R$ " + value;
      }
    });

    input.addEventListener("focus", function (e) {
      e.target.value = e.target.value
        .replace(/[R$\s]/g, "")
        .replace(/\./g, "")
        .replace(",", ".");
    });
  });
}

/**
 * Inicializar formatação de telefone
 */
function initPhoneFormatting() {
  const phoneInputs = document.querySelectorAll('input[name="telefone"]');
  phoneInputs.forEach(function (input) {
    input.addEventListener("input", formatPhone);
  });
}

function formatPhone(e) {
  let value = e.target.value.replace(/\D/g, "");
  if (value.length > 0) {
    if (value.length <= 2) {
      value = "(" + value;
    } else if (value.length <= 6) {
      value = "(" + value.substring(0, 2) + ") " + value.substring(2);
    } else if (value.length <= 10) {
      value =
        "(" +
        value.substring(0, 2) +
        ") " +
        value.substring(2, 6) +
        "-" +
        value.substring(6);
    } else {
      value =
        "(" +
        value.substring(0, 2) +
        ") " +
        value.substring(2, 7) +
        "-" +
        value.substring(7, 11);
    }
  }
  e.target.value = value;
}

/**
 * Inicializar animações de scroll
 */
function initScrollAnimations() {
  const observerOptions = {
    root: null,
    rootMargin: "0px",
    threshold: 0.1,
  };

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add("animate-in");
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  const animateElements = document.querySelectorAll(".animate-on-scroll");
  animateElements.forEach(function (el) {
    observer.observe(el);
  });
}

/**
 * Função global para formatar moeda
 */
function formatarMoeda(valor) {
  return new Intl.NumberFormat("pt-BR", {
    style: "currency",
    currency: "BRL",
  }).format(valor);
}

/**
 * Função global para validar email
 */
function validarEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email);
}

/**
 * Função global para mostrar toast notification
 */
function mostrarToast(tipo, mensagem, duracao = 5000) {
  let toastContainer = document.getElementById("toast-container");
  if (!toastContainer) {
    toastContainer = document.createElement("div");
    toastContainer.id = "toast-container";
    toastContainer.className = "toast-container position-fixed top-0 end-0 p-3";
    toastContainer.style.zIndex = "9999";
    document.body.appendChild(toastContainer);
  }

  const toastId = "toast-" + Date.now();
  const bgClass =
    tipo === "success"
      ? "bg-success"
      : tipo === "danger"
      ? "bg-danger"
      : tipo === "warning"
      ? "bg-warning"
      : "bg-info";
  const icon =
    tipo === "success"
      ? "bi-check-circle"
      : tipo === "danger"
      ? "bi-x-circle"
      : tipo === "warning"
      ? "bi-exclamation-triangle"
      : "bi-info-circle";

  const toastHtml = `
        <div id="${toastId}" class="toast align-items-center text-white ${bgClass} border-0 fade-in" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi ${icon} me-2"></i>${mensagem}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    `;

  toastContainer.insertAdjacentHTML("beforeend", toastHtml);

  const toastEl = document.getElementById(toastId);
  const toast = new bootstrap.Toast(toastEl, { delay: duracao });
  toast.show();

  toastEl.addEventListener("hidden.bs.toast", function () {
    toastEl.remove();
  });
}

/**
 * Função para confirmar ação
 */
function confirmarAcao(mensagem, callback) {
  if (confirm(mensagem)) {
    callback();
  }
}

/**
 * Função para copiar texto para clipboard
 */
async function copiarTexto(texto) {
  try {
    await navigator.clipboard.writeText(texto);
    mostrarToast("success", "Copiado para a área de transferência!");
  } catch (err) {
    console.error("Erro ao copiar:", err);
    mostrarToast("danger", "Erro ao copiar texto");
  }
}

/**
 * Função para printar página
 */
function imprimirPagina() {
  window.print();
}

/**
 * Exportar tabela para CSV
 */
function exportarCSV(tabelaId, nomeArquivo) {
  const tabela = document.getElementById(tabelaId);
  if (!tabela) {
    mostrarToast("danger", "Tabela não encontrada");
    return;
  }

  let csv = [];
  const linhas = tabela.querySelectorAll("tr");

  linhas.forEach(function (linha) {
    let cols = linha.querySelectorAll("td, th");
    let row = [];
    cols.forEach(function (col) {
      let texto = col.innerText.replace(/"/g, '""');
      row.push('"' + texto + '"');
    });
    csv.push(row.join(","));
  });

  const csvContent = csv.join("\n");
  const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
  const link = document.createElement("a");
  const url = URL.createObjectURL(blob);

  link.setAttribute("href", url);
  link.setAttribute("download", nomeArquivo + ".csv");
  link.style.visibility = "hidden";
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

/**
 * Debounce utility
 */
function debounce(func, wait) {
  let timeout;
  return function executedFunction() {
    const context = this;
    const args = arguments;
    const later = function () {
      timeout = null;
      func.apply(context, args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

/**
 * Format number as currency
 */
function formatCurrency(value) {
  return new Intl.NumberFormat("pt-BR", {
    style: "currency",
    currency: "BRL",
  }).format(value);
}

/**
 * Format date as Brazilian format
 */
function formatDate(date) {
  return new Intl.DateTimeFormat("pt-BR", {
    day: "2-digit",
    month: "2-digit",
    year: "numeric",
  }).format(new Date(date));
}

/**
 * Format datetime as Brazilian format
 */
function formatDateTime(date) {
  return new Intl.DateTimeFormat("pt-BR", {
    day: "2-digit",
    month: "2-digit",
    year: "numeric",
    hour: "2-digit",
    minute: "2-digit",
  }).format(new Date(date));
}
