#include "cJSON.h"
#include "getFromJson.h"

int getSize(cJSON* root) {
    cJSON* mazeTile = cJSON_GetObjectItem(root, "matrix");
    if (mazeTile != NULL && cJSON_IsArray(mazeTile)) {
        int arraySize = cJSON_GetArraySize(mazeTile);
        return arraySize;
    }
}

int** getMatrix(cJSON* root) {
    cJSON* matrix = cJSON_GetObjectItem(root, "marix");  // Récupérer le tableau du niveau

    if (matrix != NULL && cJSON_IsArray(matrix) && cJSON_GetArraySize(matrix) > 0) {
        int rows = cJSON_GetArraySize(matrix);
        int** matrixArray = (int**)malloc(rows * sizeof(int*));  // Allouer un tableau de pointeurs vers des tableaux d'entiers
        for (int i = 0; i < rows; i++) {
            cJSON* row = cJSON_GetArrayItem(matrix, i);
            if (cJSON_IsArray(row)) {
                int cols = cJSON_GetArraySize(row);
                int* tab = (int*)malloc(cols * sizeof(int));  // Allouer un nouveau tableau d'entiers pour chaque ligne
                matrixArray[i] = tab;  // Ajouter le tableau à mazeArray
                for (int j = 0; j < cols; j++) {
                    cJSON* value = cJSON_GetArrayItem(row, j);
                    if (cJSON_IsNumber(value)) {
                        matrixArray[i][j] = value->valueint;  // Stocker la valeur dans le tableau correspondant
                    }
                }
            }
        }
        return matrixArray;  // Renvoyer le tableau de labyrinthe
    }
    return NULL;  // Si le tableau n'a pas été trouvé ou n'est pas valide, renvoyer NULL
}