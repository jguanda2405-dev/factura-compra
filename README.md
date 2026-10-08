# Factura de Compra (PHP)

Aplicación web en PHP + HTML (Bootstrap) que emite la factura de compra de un artículo.

## Funcionamiento

1. El usuario ingresa la descripción del artículo, la cantidad y el precio unitario.
2. El sistema calcula:
   - **Subtotal** = Cantidad × Precio unitario
   - **IVA (12%)** = Subtotal × 0.12
   - **Total con IVA** = Subtotal + IVA
3. Si el **Total con IVA** supera los **$150**, se aplica un **descuento del 15%** sobre ese monto.
4. Se muestra el desglose completo:
   - Subtotal
   - Monto del IVA
   - Total con IVA
   - Descuento aplicado (o mensaje de "no aplica")
   - Total neto a pagar

## Archivos

- `index.html` → Formulario de ingreso de datos.
- `factura.php` → Lógica de cálculo y presentación de la factura.

## Ejecución local

1. Copiar la carpeta a `htdocs` de XAMPP.
2. Iniciar Apache.
3. Abrir: `http://localhost/FacturaCompra/index.html`